<x-app-layout>
<x-slot name="header">Contact</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.ct-hero { position:relative; overflow:hidden; padding:60px 10% 110px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.ct-hero-dots { position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px); background-size:32px 32px; }
.ct-hero-glow { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent 70%); top:-100px; right:-80px; animation:glow 5s ease-in-out infinite alternate; }
@keyframes glow { from{ transform:scale(1); } to{ transform:scale(1.2); } }
.ct-hero-content { position:relative; z-index:2; text-align:center; }
.ct-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.ct-hero-title { font-family:'Playfair Display',serif; font-size:46px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:12px; }
.ct-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.ct-hero-sub { font-size:15px; color:rgba(255,255,255,0.88); max-width:440px; margin:0 auto; line-height:1.7; }
.ct-hero-chips { display:flex; justify-content:center; gap:14px; margin-top:28px; flex-wrap:wrap; }
.ct-hero-chip { display:inline-flex; align-items:center; gap:7px; padding:7px 18px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.45); backdrop-filter:blur(6px); }
.ct-hero-chip i { color:white; font-size:13px; }
.ct-hero-chip span { font-size:12px; color:white; font-weight:700; letter-spacing:0.3px; }
.ct-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.ct-body { max-width:780px; margin:0 auto; padding:40px 24px 80px; }
.ct-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px; }

.ct-info-card { background:white; border-radius:20px; border:1px solid #ede9fe; padding:20px; display:flex; align-items:center; gap:14px; box-shadow:0 4px 16px rgba(180,128,255,0.06); transition:all 0.2s; opacity:0; animation:fadeUp 0.5s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(10px); } to{ opacity:1; transform:translateY(0); } }
.ct-info-card:nth-child(1){ animation-delay:0.05s; }
.ct-info-card:nth-child(2){ animation-delay:0.1s; }
.ct-info-card:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.ct-info-icon { width:44px; height:44px; border-radius:14px; background:linear-gradient(135deg,rgba(180,128,255,0.15),rgba(211,170,149,0.1)); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.ct-info-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#c4b5fd; margin-bottom:3px; }
.ct-info-value { font-size:13px; font-weight:600; color:#1a1a2e; }

.ct-form-card { background:white; border-radius:24px; border:1px solid #ede9fe; box-shadow:0 8px 32px rgba(180,128,255,0.09); overflow:hidden; margin-bottom:24px; opacity:0; animation:fadeUp 0.5s 0.15s forwards; }
.ct-form-header { padding:24px 28px 0; }
.ct-form-title { font-size:18px; font-weight:800; color:#1a1a2e; margin-bottom:4px; display:flex; align-items:center; gap:10px; }
.ct-form-title i { color:#b480ff; }
.ct-form-sub { font-size:13px; color:#9ca3af; margin-bottom:20px; }
.ct-form-body { padding:0 28px 28px; }
.f-group { margin-bottom:16px; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.f-input { width:100%; padding:12px 16px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:all 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.08); }
textarea.f-input { resize:vertical; min-height:130px; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }
.btn-submit { display:inline-flex; align-items:center; gap:8px; padding:13px 32px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }

.ct-msg-card { background:white; border-radius:24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); overflow:hidden; opacity:0; animation:fadeUp 0.5s 0.25s forwards; }
.ct-msg-head { padding:18px 24px; border-bottom:1px solid #faf8ff; display:flex; align-items:center; gap:10px; }
.ct-msg-head-icon { width:32px; height:32px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; }
.ct-msg-head-title { font-size:15px; font-weight:800; color:#1a1a2e; }
.ct-msg-item { padding:18px 24px; border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.ct-msg-item:last-child { border-bottom:none; }
.ct-msg-item:hover { background:#fdf9ff; }
.ct-msg-item.replied { border-left:4px solid #10b981; padding-left:20px; }
.ct-msg-item.pending  { border-left:4px solid #f97316; padding-left:20px; }
.ct-msg-top { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; margin-bottom:8px; }
.ct-msg-subject { font-size:14px; font-weight:700; color:#1a1a2e; }
.ct-msg-badge { font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; flex-shrink:0; white-space:nowrap; }
.ct-msg-badge.replied { background:rgba(16,185,129,0.1); color:#059669; }
.ct-msg-badge.pending  { background:rgba(249,115,22,0.1); color:#f97316; }
.ct-msg-text { font-size:13px; color:#6b7280; line-height:1.7; margin-bottom:6px; }
.ct-msg-date { font-size:11px; color:#c4b5fd; display:flex; align-items:center; gap:5px; }
.ct-reply-box { margin-top:14px; padding:14px 16px; background:#f0fdf4; border-radius:14px; border-left:3px solid #10b981; }
.ct-reply-label { font-size:11px; font-weight:700; color:#059669; margin-bottom:6px; display:flex; align-items:center; gap:5px; }
.ct-reply-text  { font-size:13px; color:#374151; line-height:1.7; }
.ct-reply-date  { font-size:10px; color:#9ca3af; margin-top:5px; }
.ct-msg-empty { padding:48px 24px; text-align:center; }
.ct-msg-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-8px); } }
.ct-msg-empty p { font-size:13px; color:#d1d5db; line-height:1.7; }

@media(max-width:600px){ .ct-grid{ grid-template-columns:1fr; } }
</style>

<div class="ct-hero">
    <div class="ct-hero-dots"></div>
    <div class="ct-hero-glow"></div>
    <div class="ct-hero-content">
        <div class="ct-hero-tag"><i class="fa-solid fa-envelope"></i> Support</div>
        <h1 class="ct-hero-title">Get in <span>Touch</span></h1>
        <p class="ct-hero-sub">Have a question or need help? Send us a message and we'll get back to you shortly.</p>
        <div class="ct-hero-chips">
            <div class="ct-hero-chip"><i class="fa-solid fa-clock"></i><span>Quick Response</span></div>
            <div class="ct-hero-chip"><i class="fa-solid fa-shield-halved"></i><span>Secure & Private</span></div>
            <div class="ct-hero-chip"><i class="fa-solid fa-headset"></i><span>Expert Support</span></div>
        </div>
    </div>
    <div class="ct-wave"></div>
</div>

<div class="ct-body">

    <div class="ct-grid">
        <div class="ct-info-card">
            <div class="ct-info-icon"><i class="fa-solid fa-reply"></i></div>
            <div><div class="ct-info-label">Response Time</div><div class="ct-info-value">Within 24 hours</div></div>
        </div>
        <div class="ct-info-card">
            <div class="ct-info-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
            <div><div class="ct-info-label">Your Messages</div><div class="ct-info-value">{{ $messages->count() }} message(s) sent</div></div>
        </div>
    </div>

    <div class="ct-form-card">
        <div class="ct-form-header">
            <div class="ct-form-title"><i class="fa-solid fa-paper-plane"></i> Send a Message</div>
            <div class="ct-form-sub">Our team will get back to you as soon as possible.</div>
        </div>
        <div class="ct-form-body">
            @php
                $storeRoute = Auth::user()->isEstheticienne()
                    ? route('estheticienne.contact.store')
                    : route('client.contact.store');
            @endphp
            <form method="POST" action="{{ $storeRoute }}">
                @csrf
                <div class="f-group">
                    <label class="f-label">Subject *</label>
                    <input type="text" name="sujet" value="{{ old('sujet') }}" required maxlength="150" class="f-input" placeholder="e.g. Question about my appointment...">
                    @error('sujet')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group">
                    <label class="f-label">Message *</label>
                    <textarea name="message" required minlength="10" maxlength="2000" class="f-input" placeholder="Describe your question or issue in detail...">{{ old('message') }}</textarea>
                    @error('message')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
            </form>
        </div>
    </div>

    <div class="ct-msg-card">
        <div class="ct-msg-head">
            <div class="ct-msg-head-icon"><i class="fa-solid fa-inbox"></i></div>
            <div class="ct-msg-head-title">My Messages</div>
        </div>
        @if($messages->isEmpty())
            <div class="ct-msg-empty">
                <i class="fa-solid fa-envelope-open"></i>
                <p>No messages sent yet.<br>Use the form above to contact us!</p>
            </div>
        @else
            @foreach($messages as $msg)
                <div class="ct-msg-item {{ $msg->estRepondu() ? 'replied' : 'pending' }}">
                    <div class="ct-msg-top">
                        <div class="ct-msg-subject">{{ $msg->sujet }}</div>
                        <span class="ct-msg-badge {{ $msg->estRepondu() ? 'replied' : 'pending' }}">
                            @if($msg->estRepondu()) <i class="fa-solid fa-check" style="font-size:9px;"></i> Replied
                            @else <i class="fa-solid fa-clock" style="font-size:9px;"></i> Pending @endif
                        </span>
                    </div>
                    <div class="ct-msg-text">{{ $msg->message }}</div>
                    <div class="ct-msg-date"><i class="fa-regular fa-clock" style="font-size:9px;"></i> {{ $msg->created_at->format('d/m/Y at H:i') }}</div>
                    @if($msg->estRepondu())
                        <div class="ct-reply-box">
                            <div class="ct-reply-label"><i class="fa-solid fa-reply"></i> Admin Reply</div>
                            <div class="ct-reply-text">{{ $msg->reponse_admin }}</div>
                            <div class="ct-reply-date">{{ $msg->repondu_at->format('d/m/Y at H:i') }}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

</div>

{{-- TOAST --}}
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

<script>
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';
    t.style.background = type==='error' ? '#ef4444' : '#1a1a2e';
    t.style.display='flex'; t.style.opacity='1';
    clearTimeout(t._x);
    t._x=setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); },4000);
}
@if(session('success'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('success')),'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('error')),'error'); });
@endif
</script>

</x-app-layout>
