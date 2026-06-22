@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">AI Assistant</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin AI Assistant</h3>
                    </div>
                    <div class="card-body" style="height: 500px; overflow-y: auto;" id="chat-messages">
                        <div class="text-center text-muted mb-3" id="chat-start-hint">
                            Kirim pesan untuk memulai. Contoh: "tampilkan produk dengan stok kritis" atau "berapa pendapatan bulan ini?"
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="chat-form" onsubmit="sendMessage(event)">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" id="message-input" class="form-control"
                                       placeholder="Ketik pesan..." required autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" id="send-btn">
                                        <i class="fas fa-paper-plane"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#chat-messages .msg-user {
    text-align: right;
    margin-bottom: 12px;
}
#chat-messages .msg-user .bubble {
    display: inline-block;
    background: #007bff;
    color: #fff;
    padding: 8px 14px;
    border-radius: 18px 18px 4px 18px;
    max-width: 70%;
    text-align: left;
}
#chat-messages .msg-bot {
    text-align: left;
    margin-bottom: 12px;
}
#chat-messages .msg-bot .bubble {
    display: inline-block;
    background: #f1f1f1;
    color: #333;
    padding: 8px 14px;
    border-radius: 18px 18px 18px 4px;
    max-width: 70%;
    text-align: left;
}
#chat-messages .msg-bot .tool-trace {
    font-size: 11px;
    color: #6c757d;
    margin-top: 4px;
    padding-left: 4px;
}
.loading-dots::after {
    content: '...';
    animation: dots 1.5s steps(4, end) infinite;
}
@keyframes dots { 0% { content: ''; } 25% { content: '.'; } 50% { content: '..'; } 75% { content: '...'; } }
</style>

<script>
async function sendMessage(e) {
    e.preventDefault();
    const input = document.getElementById('message-input');
    const msg = input.value.trim();
    if (!msg) return;

    const messages = document.getElementById('chat-messages');
    const hint = document.getElementById('chat-start-hint');
    if (hint) hint.remove();

    // User message
    const userDiv = document.createElement('div');
    userDiv.className = 'msg-user';
    userDiv.innerHTML = `<div class="bubble">${escapeHtml(msg)}</div>`;
    messages.appendChild(userDiv);

    input.value = '';
    document.getElementById('send-btn').disabled = true;

    // Loading
    const loadDiv = document.createElement('div');
    loadDiv.className = 'msg-bot';
    loadDiv.id = 'loading-msg';
    loadDiv.innerHTML = `<div class="bubble"><span class="loading-dots">Memproses</span></div>`;
    messages.appendChild(loadDiv);
    messages.scrollTop = messages.scrollHeight;

    try {
        const res = await fetch('{{ route("admin.ai.chat") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: msg }),
        });

        const data = await res.json();
        document.getElementById('loading-msg')?.remove();

        if (data.success) {
            const botDiv = document.createElement('div');
            botDiv.className = 'msg-bot';
            let html = `<div class="bubble">${escapeHtml(data.reply)}</div>`;
            if (data.tool_trace && data.tool_trace.length) {
                html += `<div class="tool-trace">Tool: ${data.tool_trace.join(', ')}</div>`;
            }
            botDiv.innerHTML = html;
            messages.appendChild(botDiv);
        } else {
            const errDiv = document.createElement('div');
            errDiv.className = 'msg-bot';
            errDiv.innerHTML = `<div class="bubble" style="background: #f8d7da; color: #721c24;">${escapeHtml(data.reply || 'Terjadi kesalahan.')}</div>`;
            messages.appendChild(errDiv);
        }
    } catch (err) {
        document.getElementById('loading-msg')?.remove();
        const errDiv = document.createElement('div');
        errDiv.className = 'msg-bot';
        errDiv.innerHTML = `<div class="bubble" style="background: #f8d7da; color: #721c24;">Gagal terhubung ke server. Coba lagi.</div>`;
        messages.appendChild(errDiv);
    }

    document.getElementById('send-btn').disabled = false;
    messages.scrollTop = messages.scrollHeight;
}

function escapeHtml(text) {
    const d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
@endsection
