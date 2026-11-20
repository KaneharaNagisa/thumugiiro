@extends('layouts.enduser')

@section('title', 'お問い合わせ | THUMUGIIRO')

@section('content')
    <section class="mx-auto max-w-3xl px-5 py-16 sm:px-8">
        <div class="rounded-[2rem] border border-[#F8B5C5]/50 bg-white/95 p-8 shadow-sm sm:p-12">
            <p class="text-sm font-bold tracking-[0.18em] text-[#E66B7C]">CONTACT</p>
            <h1 class="mt-3 text-3xl font-bold sm:text-4xl">通常のお問い合わせ</h1>
            <p class="mt-5 leading-8 text-[#655F5B]">
                AI相談が利用できない場合も、こちらからご相談いただけます。現在フォームの受付実装準備中です。
            </p>
            <a href="mailto:hello@thumugi.info" class="mt-8 inline-flex rounded-full bg-[#E66B7C] px-7 py-3.5 font-bold text-white">メールで相談する</a>
        </div>
    </section>
@endsection
