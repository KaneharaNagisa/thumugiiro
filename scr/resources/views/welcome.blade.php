@extends('layouts.enduser')

@section('title', 'THUMUGIIRO | アイデアを、かたちに。')

@section('content')
    <section class="mx-auto grid max-w-6xl gap-14 px-5 py-20 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:py-28">
        <div>
            <p class="mb-5 text-sm font-bold tracking-[0.22em] text-[#E66B7C]">THINK WITH CARE / BUILD WITH THANKS</p>
            <h1 class="max-w-2xl text-4xl font-bold leading-tight sm:text-6xl">
                アイデアを、<br><span class="font-display text-[#E66B7C]">やさしくかたちに。</span>
            </h1>
            <p class="mt-7 max-w-xl text-base leading-8 text-[#655F5B] sm:text-lg">
                想いを丁寧に聴き、必要なものだけをつくり、育てていく。<br class="hidden sm:block">
                THUMUGIIROは、システム開発と保守のお手伝いをします。
            </p>
            <div class="mt-9 flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="rounded-full bg-[#E66B7C] px-7 py-3.5 font-bold text-white shadow-[0_8px_20px_rgba(230,107,124,0.28)] transition hover:-translate-y-0.5 hover:bg-[#D95A6C]">お問い合わせ</a>
                <button type="button" data-open-ai-chat class="rounded-full border border-[#F8B5C5] bg-white px-7 py-3.5 font-bold text-[#E66B7C] transition hover:bg-[#FFF2F5]">まずAIに相談する</button>
            </div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-1">
            <article class="rounded-[2rem] border border-[#F8B5C5]/50 bg-[#FFF2F5]/90 p-8 shadow-sm">
                <p class="font-display text-3xl text-[#E66B7C]">Think</p>
                <h2 class="mt-2 text-xl font-bold">課題の奥まで考える</h2>
                <p class="mt-3 leading-7 text-[#655F5B]">つくる前に、目的と優先順位を一緒に整理します。</p>
            </article>
            <article class="rounded-[2rem] border border-[#9FD6A3]/60 bg-[#F0F9F1]/90 p-8 shadow-sm">
                <p class="font-display text-3xl text-[#5E9A64]">Thank</p>
                <h2 class="mt-2 text-xl font-bold">感謝を、長く続く形へ</h2>
                <p class="mt-3 leading-7 text-[#655F5B]">納品後も、安心して使い続けられる保守を大切にします。</p>
            </article>
        </div>
    </section>
@endsection
