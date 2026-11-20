<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'THUMUGIIRO')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:500,600,700|zen-kaku-gothic-new:400,500,700" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="enduser-body min-h-screen text-[#363230] antialiased">
    <div class="watercolor-background" aria-hidden="true">
        <span class="watercolor-spot spot-top-coral"></span>
        <span class="watercolor-spot spot-top-yellow"></span>
        <span class="watercolor-spot spot-top-green"></span>
        <span class="watercolor-spot spot-middle-green"></span>
        <span class="watercolor-spot spot-middle-yellow"></span>
        <span class="watercolor-spot spot-middle-coral"></span>
        <span class="watercolor-spot spot-bottom-coral"></span>
        <span class="watercolor-spot spot-bottom-yellow"></span>
        <span class="watercolor-spot spot-bottom-green"></span>
    </div>

    <div class="relative z-10 mx-auto max-w-5xl px-6 py-7 sm:py-12">
        <header class="flex items-center justify-between gap-5 border-b border-stone-100 pb-7">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3 text-[#363230]" aria-label="THUMUGIIRO ホーム">
                <span class="site-logo-mark" aria-hidden="true">
                    <img src="{{ asset('images/logo01.png') }}" alt="" width="800" height="800">
                </span>
                <span class="min-w-0">
                    <span class="block font-display text-xl font-semibold tracking-[0.08em] sm:text-3xl">THUMUGIIRO</span>
                    <span class="hidden text-[0.62rem] tracking-[0.15em] text-[#8F8985] sm:block">WEB SYSTEM &amp; DESIGN ENGINEERING</span>
                </span>
            </a>
            <nav class="hidden items-center gap-6 text-xs font-medium text-stone-600 md:flex" aria-label="主要ナビゲーション">
                <a class="transition hover:text-[#E66B7C]" href="{{ route('home') }}#about">理念</a>
                <a class="transition hover:text-[#E66B7C]" href="{{ route('home') }}#services">事業内容</a>
                <a class="transition hover:text-[#E66B7C]" href="{{ route('home') }}#works">開発実績</a>
                <button type="button" data-open-ai-chat class="transition hover:text-[#E66B7C]">AI相談</button>
                <a class="site-button site-button-sakura px-4 py-2 text-xs" href="{{ route('contact') }}">無料相談・お問合せ</a>
            </nav>
            <a class="site-button site-button-sakura shrink-0 px-4 py-2 text-xs md:hidden" href="{{ route('contact') }}">相談する</a>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="relative z-10 border-t border-stone-100 pb-2 pt-12 text-center">
            <div class="mb-4 flex flex-col items-center justify-center">
                <span class="site-logo-mark site-logo-mark-footer mb-2" aria-hidden="true">
                    <img src="{{ asset('images/logo01.png') }}" alt="" width="800" height="800">
                </span>
                <p class="font-display text-xl font-semibold tracking-[0.14em] text-stone-700">THUMUGIIRO</p>
                <p class="mt-1 text-[0.65rem] tracking-wider text-[#8F8985]">想いを紡ぎ、感謝で結ぶシステム開発</p>
            </div>
            <p class="text-xs text-stone-400">&copy; {{ now()->year }} THUMUGIIRO. All Rights Reserved.</p>
        </footer>
    </div>

    @include('components.ai-chat-widget')

    <script>
        window.aiChatConfig = {
            sessionUrl: @json(route('ai-chat.session')),
            messageUrl: @json(route('ai-chat.messages.store')),
            contactUrl: @json(route('contact')),
        };
    </script>
</body>
</html>
