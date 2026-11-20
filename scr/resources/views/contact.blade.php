@extends('layouts.enduser')

@section('title', '無料相談・お問い合わせ | THUMUGIIRO')

@section('content')
    <section class="my-16 sm:my-24">
        <div class="section-heading">
            <p>06 / Contact</p>
            <h1 class="text-2xl font-bold tracking-[0.08em] text-stone-800 sm:text-3xl">無料相談・お見積もり</h1>
            <span>専門用語は不要です。まずはお困りごとをお聞かせください</span>
        </div>

        <form action="mailto:hello@thumugi.info" method="get" enctype="text/plain" class="mx-auto max-w-2xl space-y-6 rounded-[2.5rem] border border-stone-100 bg-white/95 p-8 shadow-[0_4px_20px_rgba(0,0,0,0.025)] backdrop-blur-md sm:p-10">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-xs font-bold text-stone-700">お名前 <span class="text-[#E66B7C]">必須</span></label>
                    <input id="name" name="お名前" type="text" class="field-input" placeholder="例）山田 花子" required>
                </div>
                <div>
                    <label for="email" class="mb-2 block text-xs font-bold text-stone-700">メールアドレス <span class="text-[#E66B7C]">必須</span></label>
                    <input id="email" name="メールアドレス" type="email" class="field-input" placeholder="example@domain.jp" required>
                </div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="budget" class="mb-2 block text-xs font-bold text-stone-700">ご予算の目安</label>
                    <select id="budget" name="ご予算の目安" class="field-input">
                        <option>未定・相談して決めたい</option>
                        <option>30万円 〜 50万円</option>
                        <option>50万円 〜 100万円</option>
                        <option>100万円以上</option>
                    </select>
                </div>
                <div>
                    <label for="timing" class="mb-2 block text-xs font-bold text-stone-700">ご希望の公開時期</label>
                    <input id="timing" name="ご希望の公開時期" type="text" class="field-input" placeholder="例）2027年春頃までに">
                </div>
            </div>
            <div>
                <label for="message" class="mb-2 block text-xs font-bold text-stone-700">ご相談内容</label>
                <textarea id="message" name="ご相談内容" rows="5" class="field-input resize-y" placeholder="「手作業のExcel管理を自動化したい」「サイトの保守だけお願いしたい」など、思いつくままにお書きください。"></textarea>
            </div>
            <div class="pt-2 text-center">
                <button type="submit" class="site-button site-button-primary px-8 py-3 text-sm sm:px-10">この内容で無料相談を送信する</button>
                <p class="mt-3 text-[0.7rem] leading-relaxed text-stone-400">メールアプリが起動します。送信前に内容をご確認ください。2営業日以内に丁寧にご返信いたします。</p>
            </div>
        </form>
    </section>
@endsection
