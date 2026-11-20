<?php

namespace App\Http\Controllers;

use App\Models\AiChatSession;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MemberAiChatController extends Controller
{
    public function index(Request $request): View
    {
        $chatSessions = $request->user()
            ->aiChatSessions()
            ->with('messages')
            ->withCount('messages')
            ->latest('last_message_at')
            ->paginate(10);

        return view('mypage.ai-consultations.index', compact('chatSessions'));
    }

    public function show(Request $request, AiChatSession $chatSession): View
    {
        abort_unless($chatSession->user_id === $request->user()->id, 404);

        $chatSession->load(['messages' => fn ($query) => $query->oldest()]);

        return view('mypage.ai-consultations.show', compact('chatSession'));
    }
}
