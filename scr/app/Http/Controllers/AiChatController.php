<?php

namespace App\Http\Controllers;

use App\Models\AiChatMessage;
use App\Models\AiChatSession;
use App\Services\AiConsultationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class AiChatController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $chatSession = $this->currentSession($request);

        return response()->json([
            'session' => $chatSession ? [
                'id' => $chatSession->id,
                'title' => $chatSession->title,
            ] : null,
            'messages' => $chatSession
                ? $chatSession->messages()
                    ->oldest()
                    ->get(['id', 'role', 'content', 'created_at'])
                    ->map(fn (AiChatMessage $message) => [
                        'id' => $message->id,
                        'role' => $message->role,
                        'content' => $message->content,
                        'created_at' => $message->created_at->toIso8601String(),
                    ])
                : [],
        ]);
    }

    public function store(Request $request, AiConsultationService $consultation): JsonResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:4000'],
        ]);

        $content = trim($validated['content']);

        if ($content === '') {
            return response()->json([
                'message' => '相談内容を入力してください。',
                'errors' => ['content' => ['相談内容を入力してください。']],
            ], 422);
        }

        $chatSession = $this->sessionForMessage($request);

        $userMessage = DB::transaction(function () use ($chatSession, $content) {
            $message = $chatSession->messages()->create([
                'role' => 'user',
                'content' => $content,
            ]);

            $chatSession->update([
                'title' => $chatSession->title ?: Str::limit($content, 36),
                'last_message_at' => now(),
            ]);

            return $message;
        });

        try {
            $reply = $consultation->respond($chatSession);
        } catch (Throwable) {
            return response()->json([
                'message' => '現在AI相談を利用できません。入力内容は保存しました。通常のお問い合わせをご利用ください。',
                'available' => false,
                'contact_url' => route('contact'),
                'user_message' => $this->messagePayload($userMessage),
            ], 503);
        }

        $assistantMessage = DB::transaction(function () use ($chatSession, $reply) {
            $message = $chatSession->messages()->create([
                'role' => 'assistant',
                'content' => $reply['content'],
                'input_tokens' => $reply['input_tokens'],
                'output_tokens' => $reply['output_tokens'],
                'metadata' => ['model' => $reply['model']],
            ]);

            $chatSession->update(['last_message_at' => now()]);

            return $message;
        });

        return response()->json([
            'available' => true,
            'session_id' => $chatSession->id,
            'user_message' => $this->messagePayload($userMessage),
            'assistant_message' => $this->messagePayload($assistantMessage),
        ]);
    }

    private function sessionForMessage(Request $request): AiChatSession
    {
        if ($chatSession = $this->currentSession($request)) {
            return $chatSession;
        }

        return AiChatSession::create([
            'user_id' => $request->user()?->id,
            'guest_token' => $request->user()
                ? null
                : $this->guestToken($request),
            'status' => 'open',
            'last_message_at' => now(),
        ]);
    }

    private function currentSession(Request $request): ?AiChatSession
    {
        $guestToken = $request->session()->get('ai_chat_guest_token');
        $user = $request->user();

        if ($user && is_string($guestToken)) {
            AiChatSession::query()
                ->whereNull('user_id')
                ->where('guest_token', $guestToken)
                ->update(['user_id' => $user->id]);
        }

        if ($user) {
            return AiChatSession::query()
                ->where('user_id', $user->id)
                ->where('status', 'open')
                ->latest('last_message_at')
                ->first();
        }

        if (! is_string($guestToken)) {
            return null;
        }

        return AiChatSession::query()
            ->where('guest_token', $guestToken)
            ->whereNull('user_id')
            ->where('status', 'open')
            ->latest('last_message_at')
            ->first();
    }

    private function guestToken(Request $request): string
    {
        $token = $request->session()->get('ai_chat_guest_token');

        if (! is_string($token) || strlen($token) !== 64) {
            $token = Str::random(64);
            $request->session()->put('ai_chat_guest_token', $token);
        }

        return $token;
    }

    /**
     * @return array{id: int, role: string, content: string, created_at: string}
     */
    private function messagePayload(AiChatMessage $message): array
    {
        return [
            'id' => $message->id,
            'role' => $message->role,
            'content' => $message->content,
            'created_at' => $message->created_at->toIso8601String(),
        ];
    }
}
