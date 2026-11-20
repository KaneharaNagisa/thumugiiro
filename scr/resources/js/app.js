import './bootstrap';

const widget = document.querySelector('#ai-chat-widget');

if (widget && window.aiChatConfig) {
    const panel = widget.querySelector('#ai-chat-panel');
    const toggle = widget.querySelector('#ai-chat-toggle');
    const close = widget.querySelector('#ai-chat-close');
    const form = widget.querySelector('#ai-chat-form');
    const input = widget.querySelector('#ai-chat-input');
    const submit = widget.querySelector('#ai-chat-submit');
    const messages = widget.querySelector('#ai-chat-messages');
    const status = widget.querySelector('#ai-chat-status');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    let loaded = false;

    const scrollToBottom = () => {
        messages.scrollTop = messages.scrollHeight;
    };

    const appendMessage = (role, content, loading = false) => {
        const bubble = document.createElement('div');
        bubble.className = `chat-bubble chat-bubble-${role === 'user' ? 'user' : 'assistant'}`;
        bubble.textContent = content;

        if (loading) {
            bubble.classList.add('chat-bubble-loading');
        }

        messages.appendChild(bubble);
        scrollToBottom();

        return bubble;
    };

    const showStatus = (message) => {
        status.textContent = message;
        status.classList.toggle('hidden', !message);
    };

    const loadHistory = async () => {
        if (loaded) return;

        try {
            const response = await window.axios.get(window.aiChatConfig.sessionUrl);
            const history = response.data.messages || [];

            if (history.length) {
                messages.replaceChildren();
                history.forEach((message) => appendMessage(message.role, message.content));
            }

            loaded = true;
        } catch {
            showStatus('履歴を読み込めませんでした。相談の入力はできます。');
        }
    };

    const openPanel = () => {
        panel.classList.remove('hidden');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'AI事前相談を閉じる');
        loadHistory();
        window.setTimeout(() => input.focus(), 0);
    };

    const closePanel = () => {
        panel.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'AI事前相談を開く');
        toggle.focus();
    };

    toggle.addEventListener('click', () => {
        if (panel.classList.contains('hidden')) openPanel();
        else closePanel();
    });

    close.addEventListener('click', closePanel);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !panel.classList.contains('hidden')) closePanel();
    });

    document.querySelectorAll('[data-open-ai-chat]').forEach((button) => {
        button.addEventListener('click', openPanel);
    });

    input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = `${Math.min(input.scrollHeight, 112)}px`;
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const content = input.value.trim();

        if (!content || submit.disabled) return;

        appendMessage('user', content);
        input.value = '';
        input.style.height = 'auto';
        submit.disabled = true;
        showStatus('AIが回答を準備しています…');
        const loading = appendMessage('assistant', '考えています', true);

        try {
            const response = await window.axios.post(
                window.aiChatConfig.messageUrl,
                { content },
                { headers: { 'X-CSRF-TOKEN': csrfToken } },
            );

            loading.remove();
            appendMessage('assistant', response.data.assistant_message.content);
            showStatus('');
        } catch (error) {
            loading.remove();
            const responseMessage = error.response?.data?.message
                ?? '送信できませんでした。時間をおいてもう一度お試しください。';
            appendMessage('assistant', `${responseMessage}\nお問い合わせ: ${window.aiChatConfig.contactUrl}`);
            showStatus('通常のお問い合わせもご利用いただけます。');
        } finally {
            submit.disabled = false;
            input.focus();
        }
    });
}
