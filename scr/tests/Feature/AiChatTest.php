<?php

namespace Tests\Feature;

use App\Models\AiChatSession;
use App\Models\User;
use App\Services\AiConsultationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Tests\TestCase;

class AiChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_messages_are_stored_in_one_session(): void
    {
        $consultation = $this->mock(AiConsultationService::class);
        $consultation->shouldReceive('respond')
            ->twice()
            ->andReturn(
                ['content' => '目的を教えてください。', 'input_tokens' => 10, 'output_tokens' => 8, 'model' => 'test'],
                ['content' => '予算感はありますか。', 'input_tokens' => 20, 'output_tokens' => 9, 'model' => 'test'],
            );

        $first = $this->postJson('/ai-chat/messages', ['content' => '予約サイトを作りたいです']);
        $second = $this->postJson('/ai-chat/messages', ['content' => '予算は100万円程度です']);

        $first->assertOk()->assertJsonPath('available', true);
        $second->assertOk()->assertJsonPath('available', true);

        $this->assertDatabaseCount('ai_chat_sessions', 1);
        $this->assertDatabaseCount('ai_chat_messages', 4);
        $this->assertDatabaseHas('ai_chat_sessions', [
            'user_id' => null,
            'title' => '予約サイトを作りたいです',
        ]);
    }

    public function test_guest_history_is_claimed_after_login(): void
    {
        $this->mock(AiConsultationService::class)
            ->shouldReceive('respond')
            ->once()
            ->andReturn([
                'content' => '詳細を教えてください。',
                'input_tokens' => 4,
                'output_tokens' => 7,
                'model' => 'test',
            ]);

        $this->postJson('/ai-chat/messages', ['content' => '保守を相談したい'])->assertOk();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('/ai-chat/session')
            ->assertOk()
            ->assertJsonCount(2, 'messages');

        $this->assertDatabaseHas('ai_chat_sessions', ['user_id' => $user->id]);
    }

    public function test_user_message_is_preserved_when_ai_is_unavailable(): void
    {
        $this->mock(AiConsultationService::class)
            ->shouldReceive('respond')
            ->once()
            ->andThrow(new RuntimeException('Unavailable'));

        $this->postJson('/ai-chat/messages', ['content' => '納期について相談したい'])
            ->assertServiceUnavailable()
            ->assertJsonPath('available', false)
            ->assertJsonPath('contact_url', route('contact'));

        $this->assertDatabaseHas('ai_chat_messages', [
            'role' => 'user',
            'content' => '納期について相談したい',
        ]);
    }

    public function test_member_can_view_only_own_chat_history(): void
    {
        $member = User::factory()->create();
        $other = User::factory()->create();
        $memberChat = $this->chatSessionFor($member, '会員の相談');
        $otherChat = $this->chatSessionFor($other, '他人の相談');

        $this->actingAs($member)
            ->get(route('mypage.ai-consultations.index'))
            ->assertOk()
            ->assertSee('会員の相談')
            ->assertDontSee('他人の相談');

        $this->actingAs($member)
            ->get(route('mypage.ai-consultations.show', $memberChat))
            ->assertOk()
            ->assertSee('相談内容です');

        $this->actingAs($member)
            ->get(route('mypage.ai-consultations.show', $otherChat))
            ->assertNotFound();
    }

    public function test_chat_message_is_required(): void
    {
        $this->postJson('/ai-chat/messages', ['content' => '   '])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('content');
    }

    private function chatSessionFor(User $user, string $title): AiChatSession
    {
        $chatSession = AiChatSession::create([
            'user_id' => $user->id,
            'title' => $title,
            'status' => 'open',
            'last_message_at' => now(),
        ]);
        $chatSession->messages()->create([
            'role' => 'user',
            'content' => '相談内容です',
        ]);

        return $chatSession;
    }
}
