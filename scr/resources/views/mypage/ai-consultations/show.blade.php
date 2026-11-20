@extends('layouts.enduser')

@section('title', '相談詳細 | THUMUGIIRO')

@section('content')
    <section class="mx-auto max-w-4xl px-5 py-14 sm:px-8">
        <a href="{{ route('mypage.ai-consultations.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#E66B7C]">
            <span aria-hidden="true">←</span> AI相談履歴へ戻る
        </a>
        <div class="mt-6 rounded-[2rem] border border-[#F8B5C5]/45 bg-white/95 p-5 shadow-sm sm:p-9">
            <div class="border-b border-[#F8B5C5]/35 pb-6">
                <p class="text-sm font-bold tracking-[0.18em] text-[#E66B7C]">CONSULTATION</p>
                <h1 class="mt-2 text-2xl font-bold sm:text-3xl">{{ $chatSession->title ?: 'タイトル未設定の相談' }}</h1>
                <p class="mt-3 text-sm text-[#8F8985]">相談日時: {{ $chatSession->created_at->timezone('Asia/Tokyo')->format('Y年n月j日 H:i') }}</p>
            </div>

            <div class="space-y-5 py-7">
                @foreach ($chatSession->messages as $message)
                    <article class="flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message->role === 'user' ? 'bg-[#FFF2F5] rounded-br-md' : 'bg-[#F0F9F1] rounded-bl-md' }} max-w-[90%] rounded-[1.5rem] px-5 py-4 sm:max-w-[80%]">
                            <p class="mb-2 text-xs font-bold {{ $message->role === 'user' ? 'text-[#E66B7C]' : 'text-[#47744D]' }}">{{ $message->role === 'user' ? 'あなた' : 'AI' }}</p>
                            <p class="whitespace-pre-wrap text-sm leading-7">{{ $message->content }}</p>
                            <time class="mt-2 block text-right text-[11px] text-[#8F8985]">{{ $message->created_at->timezone('Asia/Tokyo')->format('n月j日 H:i') }}</time>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
