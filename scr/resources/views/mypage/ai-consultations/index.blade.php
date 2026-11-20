@extends('layouts.enduser')

@section('title', 'AI相談履歴 | THUMUGIIRO')

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-14 sm:px-8">
        <div class="mb-8">
            <p class="text-sm font-bold tracking-[0.2em] text-[#E66B7C]">MY PAGE</p>
            <h1 class="mt-2 text-3xl font-bold sm:text-4xl">AI相談履歴</h1>
            <p class="mt-3 text-[#655F5B]">これまでの相談内容を確認できます。</p>
        </div>

        <div class="space-y-4">
            @forelse ($chatSessions as $chatSession)
                <a href="{{ route('mypage.ai-consultations.show', $chatSession) }}" class="block rounded-[1.75rem] border border-[#F8B5C5]/45 bg-white/95 p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-[#E66B7C]/60 hover:shadow-md">
                    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                        <div>
                            <h2 class="font-bold">{{ $chatSession->title ?: 'タイトル未設定の相談' }}</h2>
                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-[#655F5B]">{{ $chatSession->messages->firstWhere('role', 'user')?->content }}</p>
                        </div>
                        <div class="shrink-0 text-sm text-[#8F8985]">
                            {{ optional($chatSession->last_message_at)->timezone('Asia/Tokyo')->format('Y年n月j日 H:i') }}
                            <span class="ml-3 rounded-full bg-[#F0F9F1] px-3 py-1 text-xs font-bold text-[#47744D]">{{ $chatSession->messages_count }}件</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-[2rem] border border-[#F8B5C5]/40 bg-white/90 p-10 text-center">
                    <p class="text-lg font-bold">まだAI相談履歴はありません</p>
                    <p class="mt-3 text-sm text-[#655F5B]">右下のAI相談ボタンから、最初の相談を始められます。</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $chatSessions->links() }}</div>
    </section>
@endsection
