<?php

namespace App\Services;

use App\Models\AiChatSession;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class AiConsultationService
{
    /**
     * @return array{content: string, input_tokens: ?int, output_tokens: ?int, model: string}
     */
    public function respond(AiChatSession $chatSession): array
    {
        $key = config('services.ai_consultation.key');
        $endpoint = config('services.ai_consultation.endpoint');
        $model = config('services.ai_consultation.model');

        if (! is_string($key) || $key === '' || ! is_string($endpoint) || $endpoint === '') {
            throw new RuntimeException('AI consultation is not configured.');
        }

        $messages = $chatSession->messages()
            ->latest()
            ->limit(20)
            ->get(['role', 'content'])
            ->map(fn ($message) => [
                'role' => $message->role,
                'content' => $message->content,
            ])
            ->reverse()
            ->values()
            ->all();

        array_unshift($messages, [
            'role' => 'system',
            'content' => <<<'PROMPT'
あなたはTHUMUGIIROの事前相談アシスタントです。依頼内容の目的、必要な機能、予算感、希望納期を丁寧に整理してください。
正式な見積もり、契約、納期、価格の確定は行わず、断定的な回答や個人情報の要求も避けてください。
回答は簡潔な日本語で、必要に応じて質問を1つずつ返してください。
PROMPT,
        ]);

        try {
            $response = Http::withToken($key)
                ->acceptJson()
                ->asJson()
                ->timeout((int) config('services.ai_consultation.timeout', 20))
                ->post($endpoint, [
                    'model' => $model,
                    'messages' => $messages,
                ])
                ->throw()
                ->json();
        } catch (RequestException $exception) {
            throw new RuntimeException('AI consultation request failed.', previous: $exception);
        }

        $content = data_get($response, 'choices.0.message.content');

        if (! is_string($content) || trim($content) === '') {
            throw new RuntimeException('AI consultation returned an empty response.');
        }

        return [
            'content' => trim($content),
            'input_tokens' => data_get($response, 'usage.prompt_tokens'),
            'output_tokens' => data_get($response, 'usage.completion_tokens'),
            'model' => (string) $model,
        ];
    }
}
