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
        <span class="watercolor-spot watercolor-spot-top"></span>
        <span class="watercolor-spot watercolor-spot-middle"></span>
        <span class="watercolor-spot watercolor-spot-bottom"></span>
    </div>

    <header class="relative z-10 border-b border-[#F8B5C5]/30 bg-white/85 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ route('home') }}" class="font-display text-3xl font-semibold tracking-[0.08em] text-[#363230]">
                THUMUGIIRO
            </a>
            <nav class="flex items-center gap-3 text-sm font-medium sm:gap-6" aria-label="主要ナビゲーション">
                <a class="transition hover:text-[#E66B7C]" href="{{ route('contact') }}">お問い合わせ</a>
                @auth
                    <a class="transition hover:text-[#E66B7C]" href="{{ route('mypage.ai-consultations.index') }}">マイページ</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="relative z-10">
        @yield('content')
    </main>

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
