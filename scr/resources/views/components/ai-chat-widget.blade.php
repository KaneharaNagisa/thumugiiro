<section id="ai-chat-widget" class="fixed bottom-5 right-4 z-50 sm:bottom-7 sm:right-7" aria-label="AI事前相談">
    <div id="ai-chat-panel" class="mb-4 hidden w-[calc(100vw-2rem)] max-w-[390px] overflow-hidden rounded-[2rem] border border-[#F8B5C5]/60 bg-white shadow-[0_24px_70px_rgba(54,50,48,0.2)]" role="dialog" aria-modal="false" aria-labelledby="ai-chat-title">
        <div class="flex items-center justify-between bg-[#FFF2F5] px-5 py-4">
            <div class="flex items-center gap-3">
                <span class="flex size-10 items-center justify-center rounded-full bg-[#E66B7C] text-white" aria-hidden="true">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2M20 14h2M9 13v2M15 13v2"/></svg>
                </span>
                <div>
                    <h2 id="ai-chat-title" class="font-bold text-[#363230]">AI事前相談</h2>
                    <p class="text-xs text-[#8F8985]">相談内容をいっしょに整理します</p>
                </div>
            </div>
            <button id="ai-chat-close" type="button" class="flex size-9 items-center justify-center rounded-full text-[#363230] transition hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E66B7C]" aria-label="チャットを閉じる">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="m18 6-12 12M6 6l12 12"/></svg>
            </button>
        </div>

        <div id="ai-chat-messages" class="chat-scrollbar flex h-[330px] flex-col gap-3 overflow-y-auto bg-white px-4 py-5 sm:h-[390px]" aria-live="polite">
            <div class="chat-bubble chat-bubble-assistant">こんにちは。作りたいものや、いまお困りのことを教えてください。目的・予算感・希望納期を整理します。</div>
        </div>

        <div class="border-t border-[#F8B5C5]/35 px-4 py-4">
            <div class="mb-3 rounded-2xl bg-[#F0F9F1] px-3 py-2 text-[11px] leading-relaxed text-[#4F594F]">
                AIの回答には誤りが含まれる場合があります。個人情報・機微情報・パスワードは入力しないでください。
            </div>
            <form id="ai-chat-form" class="flex items-end gap-2">
                <label class="sr-only" for="ai-chat-input">相談内容</label>
                <textarea id="ai-chat-input" class="min-h-12 max-h-28 flex-1 resize-none rounded-2xl border border-[#DED9D6] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#F8B5C5] focus:ring-4 focus:ring-[#F8B5C5]/20" rows="1" maxlength="4000" placeholder="相談内容を入力…" required></textarea>
                <button id="ai-chat-submit" type="submit" class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#E66B7C] text-white shadow-[0_8px_20px_rgba(230,107,124,0.3)] transition hover:-translate-y-0.5 hover:bg-[#D95A6C] disabled:cursor-not-allowed disabled:opacity-50" aria-label="送信">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </form>
            <p id="ai-chat-status" class="mt-2 hidden text-xs text-[#E66B7C]" role="status"></p>
        </div>
    </div>

    <button id="ai-chat-toggle" type="button" class="ml-auto flex size-16 items-center justify-center rounded-full border-4 border-white bg-[#E66B7C] text-white shadow-[0_14px_35px_rgba(230,107,124,0.4)] transition hover:-translate-y-1 hover:bg-[#D95A6C] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#E66B7C]" aria-label="AI事前相談を開く" aria-expanded="false" aria-controls="ai-chat-panel">
        <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2M20 14h2M9 13v2M15 13v2"/></svg>
        <span class="sr-only">AI事前相談</span>
    </button>
</section>
