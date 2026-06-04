<x-app-layout>
<x-slot name="header">My Reviews</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.avi-hero { position:relative; overflow:hidden; padding:56px 10% 100px; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); margin:-32px -24px 0; }
.avi-hero-sparkles { position:absolute; inset:0; }
.avi-sparkle { position:absolute; font-size:14px; opacity:0; animation:twinkle ease-in-out infinite; }
@keyframes twinkle { 0%,100%{ opacity:0; transform:scale(0.7) rotate(0deg); } 50%{ opacity:0.6; transform:scale(1) rotate(20deg); } }
.avi-hero-content { position:relative; z-index:2; text-align:center; }
.avi-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.avi-hero-title { font-family:'Playfair Display',serif; font-size:44px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:10px; }
.avi-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.avi-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); margin-bottom:28px; }
.avi-hero-btn { display:inline-flex; align-items:center; gap:8px; padding:11px 24px; border-radius:30px; background:white; color:#7c3aed; font-size:13px; font-weight:700; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 18px rgba(180,128,255,0.3); }
.avi-hero-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(180,128,255,0.4); }
.avi-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.avi-body { max-width:820px; margin:0 auto; padding:40px 24px 80px; }

.avi-empty { background:white; border-radius:24px; border:1px solid #ede9fe; padding:72px 24px; text-align:center; }
.avi-empty-star { font-size:64px; margin-bottom:18px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-10px); } }
.avi-empty h3 { font-size:22px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:8px; }
.avi-empty p  { font-size:14px; color:#6b7280; margin-bottom:20px; line-height:1.7; }

.avi-card { background:white; border-radius:22px; border:1px solid #ede9fe; box-shadow:0 4px 16px rgba(180,128,255,0.06); margin-bottom:14px; overflow:hidden; transition:all 0.3s; display:flex; opacity:0; animation:slideIn 0.4s forwards; }
.avi-card:nth-child(1){animation-delay:0s} .avi-card:nth-child(2){animation-delay:.07s} .avi-card:nth-child(3){animation-delay:.14s} .avi-card:nth-child(4){animation-delay:.21s}
@keyframes slideIn { from{opacity:0;transform:translateY(16px);} to{opacity:1;transform:translateY(0);} }
.avi-card:hover { transform:translateY(-3px); box-shadow:0 12px 36px rgba(180,128,255,0.12); border-color:#c4b5fd; }
.avi-card-stripe { width:5px; flex-shrink:0; }
.avi-card-stripe.esthe    { background:linear-gradient(to bottom,#b480ff,#d3aa95); }
.avi-card-stripe.institut { background:linear-gradient(to bottom,#ec4899,#f97316); }
.avi-card-body { flex:1; padding:18px 22px; }
.avi-card-top { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:10px; flex-wrap:wrap; }
.avi-card-type { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px; display:flex; align-items:center; gap:5px; }
.avi-card-type.esthe    { color:#b480ff; }
.avi-card-type.institut { color:#ec4899; }
.avi-card-name { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:6px; }
.avi-stars-row { display:flex; gap:3px; align-items:center; }
.avi-star-f { color:#f59e0b; font-size:16px; }
.avi-star-e { color:#e5e7eb; font-size:16px; }
.avi-star-num { font-size:12px; font-weight:700; color:#6b7280; margin-left:5px; }
.avi-card-right { display:flex; flex-direction:column; align-items:flex-end; gap:8px; flex-shrink:0; }
.avi-card-date { font-size:11px; color:#c4b5fd; }
.avi-status { font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; }
.avi-status.pending { background:rgba(249,115,22,0.1); color:#f97316; }
.avi-status.publie  { background:rgba(16,185,129,0.1); color:#059669; }
.avi-status.refuse  { background:rgba(239,68,68,0.1); color:#ef4444; }
.avi-comment { font-size:13px; color:#374151; font-style:italic; line-height:1.7; padding:10px 14px; background:#fdf9ff; border-radius:10px; border-left:3px solid rgba(180,128,255,0.2); margin-top:10px; }
.avi-refus { font-size:12px; color:#ef4444; background:rgba(239,68,68,0.05); border:1px solid rgba(239,68,68,0.15); border-radius:10px; padding:8px 12px; margin-top:8px; display:flex; align-items:center; gap:6px; }
.avi-card-actions { display:flex; gap:8px; margin-top:12px; }
.avi-btn-delete { padding:7px 14px; border-radius:20px; font-size:11px; font-weight:600; background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:inherit; transition:all 0.2s; display:inline-flex; align-items:center; gap:5px; }
.avi-btn-delete:hover { background:#fff5f5; }
.avi-pagination { margin-top:24px; display:flex; justify-content:center; }
</style>

<div class="avi-hero">
    <div class="avi-hero-sparkles" id="sparkles"></div>
    <div class="avi-hero-content">
        <div class="avi-hero-tag"><i class="fa-solid fa-star"></i> My Reviews</div>
        <h1 class="avi-hero-title">Your <span>Feedback</span></h1>
        <p class="avi-hero-sub">All your reviews — help us improve and celebrate our experts</p>
        <a href="{{ route('client.avis.create-institut') }}" class="avi-hero-btn">
            <i class="fa-solid fa-building"></i> Rate the Institut
        </a>
    </div>
    <div class="avi-wave"></div>
</div>

<div class="avi-body">

    @if($avis->isEmpty())
        <div class="avi-empty">
            <span class="avi-empty-star">⭐</span>
            <h3>No reviews yet</h3>
            <p>After each completed appointment, you can rate your expert.<br>Your feedback means a lot to us!</p>
        </div>
    @else
        @foreach($avis as $av)
            @php
                $isEsthe     = $av->type === 'estheticienne';
                $statusClass = match($av->statut) { 'publie'=>'publie','refuse'=>'refuse',default=>'pending' };
                $statusLabel = match($av->statut) { 'publie'=>'Published','refuse'=>'Refused',default=>'Pending' };
            @endphp
            <div class="avi-card">
                <div class="avi-card-stripe {{ $isEsthe?'esthe':'institut' }}"></div>
                <div class="avi-card-body">
                    <div class="avi-card-top">
                        <div>
                            <div class="avi-card-type {{ $isEsthe?'esthe':'institut' }}">
                                <i class="fa-solid {{ $isEsthe?'fa-user-nurse':'fa-building' }}" style="font-size:9px;"></i>
                                {{ $isEsthe ? 'Expert Review' : 'Institut Review' }}
                            </div>
                            <div class="avi-card-name">{{ $isEsthe ? $av->estheticienne?->fullName() : 'Glow Institut' }}</div>
                            <div class="avi-stars-row">
                                @for($i=1;$i<=5;$i++)
                                    <span class="{{ $i<=$av->note?'avi-star-f':'avi-star-e' }}">★</span>
                                @endfor
                                <span class="avi-star-num">{{ $av->note }}/5</span>
                            </div>
                        </div>
                        <div class="avi-card-right">
                            <span class="avi-card-date">{{ $av->created_at->format('d/m/Y') }}</span>
                            <span class="avi-status {{ $statusClass }}">
                                @if($av->statut==='publie') <i class="fa-solid fa-check" style="font-size:9px;"></i>
                                @elseif($av->statut==='refuse') <i class="fa-solid fa-xmark" style="font-size:9px;"></i>
                                @else <i class="fa-solid fa-clock" style="font-size:9px;"></i> @endif
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>
                    @if($av->commentaire)
                        <div class="avi-comment">"{{ $av->commentaire }}"</div>
                    @endif
                    @if($av->motif_refus)
                        <div class="avi-refus"><i class="fa-solid fa-circle-info" style="font-size:11px;"></i> {{ $av->motif_refus }}</div>
                    @endif
                    <div class="avi-card-actions">
                        <form action="{{ route('client.avis.supprimer', $av) }}" method="POST" id="deleteAvis{{ $av->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="avi-btn-delete"
                                onclick="glowConfirm('Delete this review?','This action cannot be undone.','Yes, delete','fa-trash','red',function(){ document.getElementById('deleteAvis{{ $av->id }}').submit(); })">
                                <i class="fa-solid fa-trash" style="font-size:10px;"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="avi-pagination">{{ $avis->links() }}</div>
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

const sp = document.getElementById('sparkles');
for(let i=0;i<20;i++){
    const s = document.createElement('div');
    s.className = 'avi-sparkle';
    s.textContent = '★';
    s.style.cssText = `left:${Math.random()*100}%;top:${Math.random()*100}%;animation-duration:${Math.random()*3+2}s;animation-delay:${Math.random()*5}s;font-size:${Math.random()*12+8}px;color:rgba(255,255,255,0.3);`;
    sp.appendChild(s);
}
</script>
</x-app-layout>
