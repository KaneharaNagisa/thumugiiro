@extends('layouts.enduser')

@section('title', 'THUMUGIIRO | 想いを紡ぎ、感謝で結ぶシステム開発')

@section('content')
    <section id="about" class="relative my-20 scroll-mt-8 py-8 sm:my-28">
        <div class="prototype-watermark" aria-hidden="true">PHILOSOPHY</div>
        <div class="relative z-10 grid items-center gap-12 md:grid-cols-12">
            <div class="relative flex flex-col items-start md:col-span-5">
                <div class="h-36 w-56 overflow-hidden rounded-2xl border border-white bg-gradient-to-br from-[#DCEEDB] via-[#FFF7DB] to-[#F9D8DF] shadow-sm"></div>
                <div class="relative -mt-8 ml-10 flex h-44 w-64 items-center justify-center overflow-hidden rounded-2xl border border-stone-100 bg-white/90 shadow-md">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_30%,rgba(248,181,197,0.32),transparent_35%),radial-gradient(circle_at_75%_70%,rgba(159,214,163,0.35),transparent_38%)]"></div>
                    <span class="site-logo-mark site-logo-mark-card relative" aria-hidden="true">
                        <img src="{{ asset('images/logo01.png') }}" alt="" width="800" height="800">
                    </span>
                </div>
            </div>
            <div class="md:col-span-7 md:pl-4">
                <p class="font-display text-sm uppercase tracking-[0.22em] text-[#8F8985]">Think &amp; Thank</p>
                <h1 class="mt-2 text-3xl font-bold leading-snug tracking-[0.08em] text-stone-800 sm:text-4xl">
                    深く想い、感謝して、<br>人と仕組みの縁を紡ぐ。
                </h1>
                <div class="mt-6 max-w-lg space-y-4 text-sm leading-7 text-stone-600">
                    <p>「THUMUGIIRO」の頭文字である “TH” には、お客様の事業の未来を深く想う「THINK」と、出会いと信頼に対する「THANK（感謝）」の祈りが込められています。</p>
                    <p>難しい専門用語を使わず、お客様の言葉に耳を傾けること。10年のLaravel開発経験をもとに、公開後も長く安心して使える丈夫な仕組みを、南信州の静かな環境から丁寧にお仕立てします。</p>
                </div>
                <a href="#services" class="site-button site-button-sakura mt-8 px-6 py-3 text-xs">
                    事業について詳しく
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            </div>
        </div>
    </section>

    <section id="services" class="relative z-10 my-20 scroll-mt-8 sm:my-28">
        <div class="section-heading">
            <p>03 / Services</p>
            <h2>ご提供できること</h2>
            <span>作って終わりではなく、長く寄り添うシステム開発</span>
        </div>
        <div class="grid gap-8 md:grid-cols-2">
            <article class="service-card border-[#F8B5C5]/25 bg-[#FFF2F5]/90">
                <div>
                    <div class="service-icon text-[#E66B7C]">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                    </div>
                    <p class="font-display text-xs font-semibold uppercase tracking-[0.18em] text-[#E66B7C]">Service 01</p>
                    <h3>オーダーメイドWebシステム開発</h3>
                    <p class="service-description">PHP / Laravelを用いた高品質な業務システム、顧客管理、予約・受発注フォームの構築。お客様の現場のフローに合わせた直感的なUIと堅牢なDBを設計します。</p>
                </div>
                <div class="service-card-footer border-[#F8B5C5]/20">
                    <span>目安：50万円〜 / 納期2ヶ月〜</span>
                    <a href="{{ route('contact') }}" class="font-bold text-[#E66B7C]">相談する →</a>
                </div>
            </article>
            <article class="service-card border-[#9FD6A3]/30 bg-[#F0F9F1]/90">
                <div>
                    <div class="service-icon text-[#47834C]">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <p class="font-display text-xs font-semibold uppercase tracking-[0.18em] text-[#47834C]">Service 02</p>
                    <h3>定期死活監視・安心見守り保守</h3>
                    <p class="service-description">毎日0時・12時の定周期ヘルスチェック、SSL証明書の更新期限管理、万が一の障害時の即時通知。IT専任者のいない中小企業・個人事業主様を代行サポートします。</p>
                </div>
                <div class="service-card-footer border-[#9FD6A3]/25">
                    <span>月額：2万円〜（定常点検込）</span>
                    <a href="{{ route('contact') }}" class="font-bold text-[#47834C]">相談する →</a>
                </div>
            </article>
        </div>
    </section>

    <section id="works" class="relative z-10 my-20 scroll-mt-8 sm:my-28">
        <div class="section-heading">
            <p>04 / Selected Works</p>
            <h2>開発・制作実績</h2>
            <span>安心と使いやすさを形にしたプロジェクト例</span>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <article class="work-card">
                <div class="work-visual from-[#FDE7ED] to-[#FFF9FA]">
                    <span class="work-window"><i class="bg-[#F8B5C5]"></i><b></b><b></b></span>
                </div>
                <div class="mb-2 flex flex-wrap gap-2"><span class="tag bg-[#FFF2F5] text-[#E66B7C]">Laravel 11</span><span class="tag">予約・決済</span></div>
                <h3>サロン・教室向け予約管理システム</h3>
                <p>LINE連携でリピート率を高め、ダブルブッキングを防止するシンプルな予約受付。</p>
                <a href="{{ route('contact') }}">詳しく相談する →</a>
            </article>
            <article class="work-card">
                <div class="work-visual from-[#E4F4E6] to-[#F8FCF8]">
                    <span class="work-window"><i class="bg-[#9FD6A3]"></i><b></b><b></b></span>
                </div>
                <div class="mb-2 flex flex-wrap gap-2"><span class="tag bg-[#F0F9F1] text-[#47834C]">API連携</span><span class="tag">会員制</span></div>
                <h3>地域コミュニティ情報プラットフォーム</h3>
                <p>地元店舗のイベントや見どころを投稿・共有できる、温かみのあるポータルサイト。</p>
                <a href="{{ route('contact') }}" class="!text-[#47834C]">詳しく相談する →</a>
            </article>
            <article class="work-card">
                <div class="work-visual from-[#FFF6D9] to-[#FFFDF4]">
                    <span class="work-window"><i class="bg-[#F3CC57]"></i><b></b><b></b></span>
                </div>
                <div class="mb-2 flex flex-wrap gap-2"><span class="tag bg-amber-50 text-amber-700">保守・監視</span><span class="tag">死活点検</span></div>
                <h3>小規模EC向け自動監視エージェント</h3>
                <p>毎日の0時・12時に決済APIを自動テスト。停止トラブルを早期検知する安心パック。</p>
                <a href="{{ route('contact') }}" class="!text-amber-700">詳しく相談する →</a>
            </article>
        </div>
    </section>

    <section id="ai-consult" class="relative z-10 my-20 scroll-mt-8 sm:my-28">
        <div class="section-heading">
            <p>05 / AI Assistant</p>
            <h2>24時間 AI事前相談</h2>
            <span>「こんなシステム作れる？」「予算感は？」にお答えします</span>
        </div>
        <div class="mx-auto max-w-xl rounded-[2.5rem] border border-stone-100 bg-white/95 p-6 shadow-[0_10px_30px_rgba(0,0,0,0.03)] backdrop-blur-md sm:p-8">
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="flex size-8 shrink-0 items-center justify-center rounded-full border border-[#F8B5C5]/50 bg-[#FFF2F5] font-display text-xs font-bold text-[#E66B7C]">TH</span>
                    <p class="chat-preview max-w-sm rounded-tl-none bg-[#FFF2F5]/70">こんにちは！THUMUGIIROのAIアシスタントです。つくりたいシステムの概要や納期、ご予算についてお気軽にお聞かせください。</p>
                </div>
                <div class="flex justify-end">
                    <p class="chat-preview max-w-sm rounded-tr-none bg-[#9FD6A3]/20">個人サロンの予約システムを検討しています。大体の予算と期間を知りたいです。</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="flex size-8 shrink-0 items-center justify-center rounded-full border border-[#F8B5C5]/50 bg-[#FFF2F5] font-display text-xs font-bold text-[#E66B7C]">TH</span>
                    <p class="chat-preview max-w-sm rounded-tl-none bg-[#FFF2F5]/70">個人サロン様向けなら、約40万〜60万円、期間は約1.5〜2ヶ月が目安です。詳しい条件はお気軽にお聞かせください。</p>
                </div>
            </div>
            <button type="button" data-open-ai-chat class="site-button site-button-primary mt-7 w-full px-6 py-3 text-sm">
                実際にAIへ相談する
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
            </button>
            <p class="mt-3 text-center text-[0.65rem] leading-relaxed text-stone-400">AIの回答は概算です。正確な要件定義・お見積もりは担当エンジニアが対応いたします。</p>
        </div>
    </section>

    <section id="contact" class="relative z-10 my-20 scroll-mt-8 sm:my-28">
        <div class="section-heading">
            <p>06 / Contact</p>
            <h2>無料相談・お見積もり</h2>
            <span>専門用語は不要です。まずはお困りごとをお聞かせください</span>
        </div>
        <div class="mx-auto max-w-2xl rounded-[2.5rem] border border-stone-100 bg-white/95 p-8 text-center shadow-[0_4px_20px_rgba(0,0,0,0.025)] backdrop-blur-md sm:p-10">
            <p class="mx-auto max-w-lg text-sm leading-7 text-stone-600">ご希望の機能、困っている作業、予算や公開時期が決まっていなくても問題ありません。まずはメールで、思いつくままにお知らせください。</p>
            <a href="{{ route('contact') }}" class="site-button site-button-primary mt-7 px-10 py-3 text-sm">無料相談フォームへ進む</a>
            <p class="mt-3 text-[0.7rem] text-stone-400">2営業日以内に丁寧にご返信いたします。強引な営業は一切行いません。</p>
        </div>
    </section>

    <section class="relative z-10 my-20 sm:my-28">
        <div class="section-heading">
            <p>07 / FAQ</p>
            <h2>よくあるご質問</h2>
        </div>
        <div class="mx-auto max-w-2xl divide-y divide-stone-100 rounded-[2.5rem] border border-stone-100 bg-white/95 p-8 shadow-[0_4px_20px_rgba(0,0,0,0.025)] backdrop-blur-md">
            <div class="faq-item">
                <h3><span>Q.</span> システムの専門用語が全くわからないのですが大丈夫ですか？</h3>
                <p>ご安心ください。お客様にプログラミングやインフラの専門知識は一切必要ありません。日頃の業務やお困りごとを普段の言葉でお話しいただければ、こちらで整理して最適な仕組みをご提案します。</p>
            </div>
            <div class="faq-item">
                <h3><span>Q.</span> 遠方からの依頼でもフルリモートで対応可能ですか？</h3>
                <p>はい、全国対応可能です。ZoomやGoogle Meetによるオンライン面談、メールやチャットツールを用いて、長野県下伊那郡から全国のお客様とスムーズに対話を進めております。</p>
            </div>
            <div class="faq-item">
                <h3><span>Q.</span> 他社が作った既存システムの改修や保守も頼めますか？</h3>
                <p>PHP / Laravelで構築されたシステムであれば喜んで承ります。仕様書が残っていない場合でもソースコードを解析し、安全にアップデートや機能追加を行います。</p>
            </div>
        </div>
    </section>
@endsection
