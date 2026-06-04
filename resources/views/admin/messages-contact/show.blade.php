<x-app-layout>
<x-slot name="header">Message Details</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.show-wrap  { margin:-24px; padding:24px; background:#f8f5ff; }
.show-inner { max-width:720px; margin:0 auto; }

/* ── TOP BAR ── */
.show-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.show-top h1 { font-size:17px; font-weight:800; color:#1a1a2e; }
.top-actions { display:flex; align-items:center; gap:8px; }
.btn-back   { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }
.btn-delete { font-size:12px; color:#ef4444; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid rgba(239,68,68,0.2); background:white; cursor:pointer; font-family:inherit; transition:all 0.2s; }
.btn-delete:hover { background:#fff5f5; }

/* ── MESSAGE CARD ── */
.msg-card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:14px; }
.msg-card-head { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:16px; gap:12px; }
.msg-subject  { font-size:16px; font-weight:800; color:#1a1a2e; margin-bottom:6px; }
.msg-from     { font-size:13px; color:#6b7280; margin-bottom:2px; }
.msg-from strong { color:#1a1a2e; }
.msg-date     { font-size:11px; color:#9ca3af; }
.msg-status   { font-size:11px; font-weight:600; padding:5px 14px; border-radius:20px; display:inline-block; flex-shrink:0; }
.msg-status.repondu    { background:rgba(16,185,129,0.1); color:#059669; }
.msg-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.msg-body     { background:#fdf9ff; border-radius:12px; padding:16px; font-size:14px; color:#374151; line-height:1.8; white-space:pre-wrap; border-left:3px solid rgba(180,128,255,0.3); }

/* ── EXISTING REPLY ── */
.reply-existing { background:rgba(16,185,129,0.04); border:1px solid rgba(16,185,129,0.2); border-radius:14px; padding:18px 20px; margin-bottom:14px; }
.reply-existing-head { font-size:12px; font-weight:700; color:#059669; margin-bottom:10px; display:flex; align-items:center; gap:6px; }
.reply-existing-body { font-size:13px; color:#374151; line-height:1.8; white-space:pre-wrap; }

/* ── REPLY FORM ── */
.reply-card  { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:14px; }
.reply-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.reply-title i { color:#b480ff; }
.f-textarea  { width:100%; padding:12px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:vertical; min-height:130px; transition:border-color 0.2s; }
.f-textarea:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
.reply-footer { display:flex; justify-content:flex-end; margin-top:14px; }
.btn-send { padding:11px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-send:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 16px rgba(180,128,255,0.3); }
</style>

<div class="show-wrap">
<div class="show-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- TOP BAR ── Back + Delete séparés du formulaire ✅ --}}
    <div class="show-top">
        <h1>Contact Message</h1>
        <div class="top-actions">
            <button type="button" class="btn-delete"
                onclick="glowConfirm('Delete Message','Permanently delete this message?','Delete','fa-trash','#ef4444',function(){ document.getElementById('form-delete-msg').submit(); })">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
            <a href="{{ route('admin.messages-contact.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- MESSAGE --}}
    <div class="msg-card">
        <div class="msg-card-head">
            <div>
                <div class="msg-subject">{{ $messagesContact->sujet }}</div>
                <div class="msg-from">From: <strong>{{ $messagesContact->user->fullName() }}</strong> ({{ $messagesContact->user->email }}) — {{ $messagesContact->user->role }}</div>
                <div class="msg-date">{{ $messagesContact->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            @if($messagesContact->estRepondu())
                <span class="msg-status repondu"><i class="fa-solid fa-check"></i> Replied</span>
            @else
                <span class="msg-status en_attente"><i class="fa-solid fa-clock"></i> Pending</span>
            @endif
        </div>
        <div class="msg-body">{{ $messagesContact->message }}</div>
    </div>

    {{-- EXISTING REPLY (lecture seule) --}}
    @if($messagesContact->estRepondu())
        <div class="reply-existing">
            <div class="reply-existing-head">
                <i class="fa-solid fa-reply"></i>
                Your reply — {{ $messagesContact->repondu_at->format('d/m/Y à H:i') }}
            </div>
            <div class="reply-existing-body">{{ $messagesContact->reponse_admin }}</div>
        </div>
    @endif

    {{-- REPLY FORM — uniquement textarea + Send ✅ --}}
    <div class="reply-card">
        <div class="reply-title">
            <i class="fa-solid fa-reply"></i>
            {{ $messagesContact->estRepondu() ? 'Edit Reply' : 'Reply' }}
        </div>
        <form id="form-reply" method="POST" action="{{ route('admin.messages-contact.repondre', $messagesContact) }}">
            @csrf @method('PATCH')
            <textarea name="reponse_admin" rows="6" required minlength="5" maxlength="2000"
                      class="f-textarea"
                      placeholder="Type your reply...">{{ old('reponse_admin') }}</textarea>
            @error('reponse_admin')<p style="font-size:11px;color:#ef4444;margin-top:5px;">{{ $message }}</p>@enderror
            <div class="reply-footer">
                <button type="submit" class="btn-send">
                    <i class="fa-solid fa-paper-plane"></i> Send Reply
                </button>
            </div>
        </form>
    </div>

</div>
</div>

{{-- Delete form — en dehors de tout autre form ✅ --}}
<form id="form-delete-msg" method="POST"
      action="{{ route('admin.messages-contact.destroy', $messagesContact) }}"
      style="display:none;">
    @csrf @method('DELETE')
</form>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid ' + (type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check') + '" style="font-size:14px;flex-shrink:0;"></i><span>' + msg + '</span>';
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex'; t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function() { t.style.opacity = '0'; setTimeout(function() { t.style.display = 'none'; }, 300); }, 4000);
}
@if(session('success'))
document.addEventListener('DOMContentLoaded', function() { showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function() { showToast(@json(session('error')), 'error'); });
@endif
</script>

</x-app-layout>
