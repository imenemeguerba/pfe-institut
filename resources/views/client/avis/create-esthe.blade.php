<x-app-layout>
<x-slot name="header">Leave a Review</x-slot>

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

.av-already { background:white; border-radius:24px; border:1.5px solid rgba(245,158,11,0.2); padding:28px; text-align:center; box-shadow:0 8px 30px rgba(245,158,11,0.08); }
.av-already i { font-size:40px; color:#f59e0b; margin-bottom:14px; display:block; }
.av-already h3 { font-size:18px; font-weight:800; color:#1a1a2e; margin-bottom:6px; }
.av-already p  { font-size:13px; color:#9ca3af; }

.av-rdv-card { background:white; border-radius:20px; border:1px solid #ede9fe; padding:18px 20px; margin-bottom:20px; display:flex; align-items:center; gap:14px; box-shadow:0 4px 16px rgba(180,128,255,0.06); opacity:0; animation:fadeUp 0.5s 0.1s forwards; }
@keyframes fadeUp { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }
.av-rdv-av { width:50px; height:50px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:18px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.av-rdv-title  { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
.av-rdv-detail { font-size:12px; color:#9ca3af; }

.av-form-card { background:white; border-radius:24px; border:1px solid #ede9fe; padding:28px; box-shadow:0 8px 32px rgba(180,128,255,0.09); opacity:0; animation:fadeUp 0.5s 0.15s forwards; }
.av-form-title { font-size:17px; font-weight:800; color:#1a1a2e; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
.av-form-title i { color:#f59e0b; }

.av-stars-wrap { margin-bottom:24px; }
.av-stars-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:12px; display:block; }
.av-stars { display:flex; gap:8px; justify-content:center; }
.av-star { font-size:48px; color:#e5e7eb; cursor:pointer; transition:all 0.15s; line-height:1; }
.av-star:hover { transform:scale(1.15); }
.av-star.active { color:#f59e0b; filter:drop-shadow(0 0 8px rgba(245,158,11,0.5)); }
.av-star-feedback { text-align:center; margin-top:10px; font-size:13px; font-weight:700; color:#f59e0b; min-height:20px; }

.f-group { margin-bottom:20px; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:8px; }
.f-textarea { width:100%; padding:14px 16px; border-radius:14px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:all 0.2s; resize:vertical; min-height:120px; }
.f-textarea:focus { border-color:#f59e0b; background:white; box-shadow:0 0 0 3px rgba(245,158,11,0.08); }
.f-char  { font-size:11px; color:#c4b5fd; margin-top:5px; text-align:right; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }

.btn-submit { width:100%; padding:14px; border-radius:30px; background:linear-gradient(to right,#f59e0b,#d97706); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px; transition:all 0.2s; box-shadow:0 6px 20px rgba(245,158,11,0.35); }
.btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(245,158,11,0.5); }
.btn-back { display:inline-flex; align-items:center; gap:6px; margin-top:14px; font-size:13px; color:#9ca3af; text-decoration:none; justify-content:center; width:100%; transition:color 0.2s; }
.btn-back:hover { color:#b480ff; }
</style>

<div class="av-hero">
    <div class="av-hero-glow"></div>
    <div class="av-hero-content">
        <div class="av-hero-tag"><i class="fa-solid fa-star"></i> Review</div>
        <h1 class="av-hero-title">Share Your <span>Experience</span></h1>
        <p class="av-hero-sub">Your feedback helps us improve and rewards our experts</p>
    </div>
    <div class="av-wave"></div>
</div>

<div class="av-body">

    @if($avisExistant)
        <div class="av-already">
            <i class="fa-solid fa-star"></i>
            <h3>Review Already Submitted</h3>
            <p>You've already left a review for this appointment.<br>Thank you for your feedback!</p>
            <a href="{{ route('client.avis.index') }}" style="display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:10px 22px;border-radius:30px;background:linear-gradient(to right,#f59e0b,#d97706);color:white;font-size:13px;font-weight:700;text-decoration:none;">
                <i class="fa-solid fa-list"></i> My Reviews
            </a>
        </div>
    @else
        <div class="av-rdv-card">
            <div class="av-rdv-av">{{ strtoupper(substr($rendezVous->estheticienne->prenom,0,1)) }}</div>
            <div>
                <div class="av-rdv-title">{{ $rendezVous->estheticienne->fullName() }}</div>
                <div class="av-rdv-detail">
                    <i class="fa-regular fa-calendar" style="color:#b480ff;font-size:10px;margin-right:4px;"></i>
                    {{ $rendezVous->date_debut->format('d/m/Y at H:i') }}
                </div>
            </div>
        </div>
        <div class="av-form-card">
            <div class="av-form-title"><i class="fa-solid fa-star"></i> Rate your experience</div>
            <form action="{{ route('client.avis.store-esthe', $rendezVous) }}" method="POST">
                @csrf
                <div class="av-stars-wrap">
                    <span class="av-stars-label">Your rating *</span>
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
                              class="f-textarea" placeholder="Share your experience with this expert...">{{ old('commentaire') }}</textarea>
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

const labels  = ['','Poor 😕','Fair 🙂','Good 😊','Very Good 🤩','Excellent ⭐'];
const stars   = document.querySelectorAll('.av-star');
const noteVal = document.getElementById('noteVal');
const feedback = document.getElementById('starFeedback');
stars.forEach((s,i) => {
    s.addEventListener('mouseenter', () => highlight(i+1, false));
    s.addEventListener('mouseleave', () => highlight(parseInt(noteVal.value)||0, true));
    s.addEventListener('click', () => { noteVal.value = i+1; highlight(i+1, true); });
});
function highlight(n, persist) {
    stars.forEach((s,i) => s.classList.toggle('active', i < n));
    feedback.textContent = n ? labels[n] : '';
    feedback.style.color = persist ? '#f59e0b' : 'rgba(245,158,11,0.6)';
}
const textarea = document.getElementById('commentaire');
const counter  = document.getElementById('charCount');
if (textarea) { counter.textContent = textarea.value.length; textarea.addEventListener('input', () => counter.textContent = textarea.value.length); }
</script>
</x-app-layout>
