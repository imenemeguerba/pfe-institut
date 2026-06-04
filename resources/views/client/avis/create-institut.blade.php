<x-app-layout>
<x-slot name="header">Rate the Institut</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.av-hero { position:relative; overflow:hidden; padding:56px 10% 100px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.av-hero-glow { position:absolute; width:350px; height:350px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%); top:-80px; right:-60px; animation:glow 4s ease-in-out infinite alternate; }
@keyframes glow { from{transform:scale(1);} to{transform:scale(1.2);} }
.av-hero-content { position:relative; z-index:2; text-align:center; }
.av-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.av-hero-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:10px; }
.av-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.av-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); }
.av-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.av-body { max-width:600px; margin:0 auto; padding:40px 24px 80px; }

.av-already { background:white; border-radius:24px; border:1.5px solid rgba(180,128,255,0.2); padding:32px; text-align:center; box-shadow:0 8px 30px rgba(180,128,255,0.08); }
.av-already-emoji { font-size:56px; margin-bottom:16px; display:block; animation:bounce 1.5s ease infinite alternate; }
@keyframes bounce { from{transform:translateY(0);} to{transform:translateY(-8px);} }
.av-already h3 { font-size:18px; font-weight:800; color:#1a1a2e; margin-bottom:8px; }
.av-already p  { font-size:13px; color:#9ca3af; line-height:1.7; }
.av-already-stars { display:flex; gap:4px; justify-content:center; margin:12px 0; }
.av-already-star { font-size:28px; }
.av-already-star.active { color:#f59e0b; }
.av-already-star.empty  { color:#e5e7eb; }
.av-already-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; margin-top:8px; }
.av-already-badge.pending { background:rgba(249,115,22,0.1); color:#f97316; }
.av-already-badge.publie  { background:rgba(16,185,129,0.1); color:#059669; }
.av-already-badge.refuse  { background:rgba(239,68,68,0.1); color:#ef4444; }

.av-institut-banner { background:white; border-radius:20px; border:1px solid #ede9fe; padding:18px 22px; margin-bottom:20px; display:flex; align-items:center; gap:16px; box-shadow:0 4px 16px rgba(180,128,255,0.06); opacity:0; animation:fadeUp 0.5s 0.1s forwards; }
@keyframes fadeUp { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }
.av-institut-logo { width:50px; height:50px; border-radius:14px; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:22px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.av-institut-name { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:2px; }
.av-institut-sub  { font-size:12px; color:#6b7280; }

.av-form-card { background:white; border-radius:24px; border:1px solid #ede9fe; padding:28px; box-shadow:0 8px 32px rgba(180,128,255,0.09); opacity:0; animation:fadeUp 0.5s 0.15s forwards; }
.av-form-title { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
.av-form-title i { color:#b480ff; }

.av-stars-wrap { margin-bottom:24px; }
.av-stars-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:12px; display:block; }
.av-stars { display:flex; gap:8px; justify-content:center; }
.av-star { font-size:48px; color:#e5e7eb; cursor:pointer; transition:all 0.15s; line-height:1; }
.av-star:hover { transform:scale(1.15); }
.av-star.active { color:#f59e0b; filter:drop-shadow(0 0 10px rgba(245,158,11,0.6)); }
.av-star-feedback { text-align:center; margin-top:10px; font-size:13px; font-weight:700; color:#f59e0b; min-height:20px; }

.f-group { margin-bottom:20px; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:8px; }
.f-textarea { width:100%; padding:14px 16px; border-radius:14px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:all 0.2s; resize:vertical; min-height:120px; }
.f-textarea:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.08); }
.f-char  { font-size:11px; color:#c4b5fd; margin-top:5px; text-align:right; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }

.btn-submit { width:100%; padding:14px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
.btn-back { display:inline-flex; align-items:center; gap:6px; margin-top:14px; font-size:13px; color:#9ca3af; text-decoration:none; justify-content:center; width:100%; transition:color 0.2s; }
.btn-back:hover { color:#b480ff; }
</style>

<div class="av-hero">
    <div class="av-hero-glow"></div>
    <div class="av-hero-content">
        <div class="av-hero-tag"><i class="fa-solid fa-building"></i> Institut Review</div>
        <h1 class="av-hero-title">Rate <span>Glow Institut</span></h1>
        <p class="av-hero-sub">Share your overall experience with our beauty institute</p>
    </div>
    <div class="av-wave"></div>
</div>

<div class="av-body">

    @if($avisExistant)
        <div class="av-already">
            <span class="av-already-emoji">🏢</span>
            <h3>Review Already Submitted</h3>
            <div class="av-already-stars">
                @for($i=1;$i<=5;$i++)
                    <span class="av-already-star {{ $i<=$avisExistant->note?'active':'empty' }}">★</span>
                @endfor
            </div>
            @if($avisExistant->commentaire)
                <p style="font-size:13px;color:#374151;font-style:italic;margin-bottom:8px;">"{{ $avisExistant->commentaire }}"</p>
            @endif
            <span class="av-already-badge {{ $avisExistant->statut==='publie'?'publie':($avisExistant->statut==='refuse'?'refuse':'pending') }}">
                @if($avisExistant->statut==='publie') <i class="fa-solid fa-check" style="font-size:9px;"></i> Published
                @elseif($avisExistant->statut==='refuse') <i class="fa-solid fa-xmark" style="font-size:9px;"></i> Refused
                @else <i class="fa-solid fa-clock" style="font-size:9px;"></i> Pending moderation
                @endif
            </span>
            <div style="margin-top:16px;">
                <a href="{{ route('client.avis.index') }}" style="display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:30px;background:linear-gradient(to right,#b480ff,#d3aa95);color:white;font-size:13px;font-weight:700;text-decoration:none;">
                    <i class="fa-solid fa-list"></i> My Reviews
                </a>
            </div>
        </div>
    @else
        <div class="av-institut-banner">
            <div class="av-institut-logo">✨</div>
            <div>
                <div class="av-institut-name">Glow Institut</div>
                <div class="av-institut-sub">Beauty & Wellness Institute</div>
            </div>
        </div>
        <div class="av-form-card">
            <div class="av-form-title"><i class="fa-solid fa-star"></i> Your Overall Rating</div>
            <form action="{{ route('client.avis.store-institut') }}" method="POST">
                @csrf
                <div class="av-stars-wrap">
                    <span class="av-stars-label">Rating *</span>
                    <div class="av-stars" id="starsRow">
                        @for($i=1;$i<=5;$i++)
                            <span class="av-star" data-note="{{ $i }}">★</span>
                        @endfor
                    </div>
                    <div class="av-star-feedback" id="starFeedback"></div>
                    <input type="hidden" name="note" id="noteVal" required>
                    @error('note')<p class="f-error" style="text-align:center;">{{ $message }}</p>@enderror
                </div>
                <div class="f-group">
                    <label class="f-label">Comment (optional)</label>
                    <textarea name="commentaire" maxlength="1000" id="commentaire"
                              class="f-textarea" placeholder="Share your overall experience with our institute...">{{ old('commentaire') }}</textarea>
                    <div class="f-char"><span id="charCount">0</span>/1000</div>
                    @error('commentaire')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> Submit My Review
                </button>
            </form>
            <a href="{{ route('client.avis.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Back to Reviews
            </a>
        </div>
    @endif

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

const labels = ['','Poor 😕','Fair 🙂','Good 😊','Very Good 🤩','Excellent ⭐'];
const stars  = document.querySelectorAll('.av-star');
const noteVal  = document.getElementById('noteVal');
const feedback = document.getElementById('starFeedback');
if (stars.length) {
    stars.forEach((s,i) => {
        s.addEventListener('mouseenter', () => highlight(i+1, false));
        s.addEventListener('mouseleave', () => highlight(parseInt(noteVal.value)||0, true));
        s.addEventListener('click', () => { noteVal.value = i+1; highlight(i+1, true); });
    });
}
function highlight(n, persist) {
    stars.forEach((s,i) => s.classList.toggle('active', i < n));
    if (feedback) { feedback.textContent = n ? labels[n] : ''; feedback.style.color = persist ? '#f59e0b' : 'rgba(245,158,11,0.6)'; }
}
const textarea = document.getElementById('commentaire');
const counter  = document.getElementById('charCount');
if (textarea) { counter.textContent = textarea.value.length; textarea.addEventListener('input', () => counter.textContent = textarea.value.length); }
</script>
</x-app-layout>
