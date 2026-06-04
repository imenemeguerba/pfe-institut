<x-app-layout>
<x-slot name="header">My Schedule</x-slot>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
.pl-wrap{margin:-24px;padding:0;background:#f8f5ff;}
.pl-hero{position:relative;overflow:hidden;padding:44px 32px 90px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.pl-hero-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);background-size:28px 28px;}
.pl-hero-orb1{position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%);top:-80px;right:-60px;animation:orbF 7s ease-in-out infinite alternate;}
.pl-hero-orb2{position:absolute;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);bottom:-40px;left:80px;animation:orbF 10s ease-in-out 2s infinite alternate;}
@keyframes orbF{from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);}}
.pl-hero-content{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.pl-hero-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 16px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;}
.pl-hero-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:white;line-height:1.2;margin-bottom:6px;}
.pl-hero-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);text-decoration:underline;text-decoration-color:rgba(255,255,255,0.35);text-underline-offset:4px;}
.pl-hero-sub{font-size:13px;color:rgba(255,255,255,0.8);}
.btn-hero-add{display:inline-flex;align-items:center;gap:7px;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:700;background:white;color:#b480ff;text-decoration:none;transition:all 0.2s;box-shadow:0 4px 16px rgba(0,0,0,0.12);}
.btn-hero-add:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,0.18);}
.pl-wave{position:absolute;bottom:-2px;left:0;right:0;height:60px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}
.pl-body{padding:24px;}
.days-grid{display:flex;flex-direction:column;gap:10px;}
.day-card{background:white;border-radius:16px;border:1px solid #ede9fe;overflow:hidden;transition:all 0.2s;box-shadow:0 2px 10px rgba(180,128,255,0.05);opacity:0;animation:fadeUp 0.4s forwards;}
.day-card:nth-child(1){animation-delay:.03s}.day-card:nth-child(2){animation-delay:.06s}.day-card:nth-child(3){animation-delay:.09s}
.day-card:nth-child(4){animation-delay:.12s}.day-card:nth-child(5){animation-delay:.15s}.day-card:nth-child(6){animation-delay:.18s}.day-card:nth-child(7){animation-delay:.21s}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.day-card:hover{border-color:#c4b5fd;box-shadow:0 6px 20px rgba(180,128,255,0.1);}
.day-header{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;}
.day-name{font-size:13px;font-weight:700;color:#1a1a2e;display:flex;align-items:center;gap:10px;}
.day-dot{width:8px;height:8px;border-radius:50%;background:#d1d5db;flex-shrink:0;}
.day-dot.active{background:#10b981;}
.day-count{font-size:10px;font-weight:700;padding:2px 9px;border-radius:20px;background:rgba(180,128,255,0.1);color:#b480ff;}
.day-add{font-size:11px;color:#b480ff;text-decoration:none;font-weight:700;display:inline-flex;align-items:center;gap:4px;padding:5px 12px;border-radius:20px;border:1.5px solid rgba(180,128,255,0.2);transition:all 0.2s;}
.day-add:hover{background:rgba(180,128,255,0.08);}
.day-slots{padding:0 20px 14px;display:flex;flex-direction:column;gap:8px;}
.slot-item{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border-radius:10px;background:rgba(16,185,129,0.05);border:1px solid rgba(16,185,129,0.15);border-left:3px solid #10b981;transition:border-color 0.2s;}
.slot-item:hover{border-left-color:#059669;}
.slot-time{font-size:13px;font-weight:700;color:#1a1a2e;font-family:monospace;display:flex;align-items:center;gap:8px;}
.slot-time i{color:#10b981;font-size:11px;}
.slot-actions{display:flex;gap:8px;}
.slot-btn{padding:5px 12px;border-radius:20px;font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;text-decoration:none;display:inline-flex;align-items:center;gap:4px;transition:all 0.2s;}
.slot-btn.edit{background:#f5f0ff;color:#7c3aed;border:1px solid #ede9fe;}
.slot-btn.edit:hover{background:#ede9fe;}
.slot-btn.del{background:white;color:#ef4444;border:1px solid rgba(239,68,68,0.2);}
.slot-btn.del:hover{background:#fff5f5;}
.day-empty{padding:0 20px 14px;}
.day-empty-text{font-size:12px;color:#d1d5db;font-style:italic;}
.day-empty-link{color:#b480ff;text-decoration:none;font-weight:600;font-size:12px;}
</style>
<div class="pl-wrap">
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="pl-hero">
    <div class="pl-hero-dots"></div><div class="pl-hero-orb1"></div><div class="pl-hero-orb2"></div>
    <div class="pl-hero-content">
        <div>
            <div class="pl-hero-tag"><i class="fa-regular fa-calendar"></i> Schedule</div>
            <div class="pl-hero-title">My Weekly <span>Schedule</span></div>
            <div class="pl-hero-sub">Define your slots so clients can book appointments.</div>
        </div>
        <a href="{{ route('estheticienne.disponibilites.create') }}" class="btn-hero-add">
            <i class="fa-solid fa-plus"></i> Add Slot
        </a>
    </div>
    <div class="pl-wave"></div>
</div>
<div class="pl-body">
    @php
        $jours = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
        $disposParJour = $disponibilites->groupBy('jour_semaine');
    @endphp
    <div class="days-grid">
        @foreach($jours as $num => $label)
            @php $slots = $disposParJour[$num] ?? collect(); @endphp
            <div class="day-card">
                <div class="day-header">
                    <div class="day-name">
                        <div class="day-dot {{ $slots->isNotEmpty()?'active':'' }}"></div>
                        {{ $label }}
                        @if($slots->isNotEmpty())<span class="day-count">{{ $slots->count() }} slot(s)</span>@endif
                    </div>
                    <a href="{{ route('estheticienne.disponibilites.create') }}?jour={{ $num }}" class="day-add">
                        <i class="fa-solid fa-plus" style="font-size:9px;"></i> Add
                    </a>
                </div>
                @if($slots->isNotEmpty())
                    <div class="day-slots">
                        @foreach($slots as $dispo)
                            <div class="slot-item">
                                <div class="slot-time">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($dispo->heure_debut)->format('H:i') }} → {{ \Carbon\Carbon::parse($dispo->heure_fin)->format('H:i') }}
                                </div>
                                <div class="slot-actions">
                                    <a href="{{ route('estheticienne.disponibilites.edit', $dispo) }}" class="slot-btn edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('estheticienne.disponibilites.destroy', $dispo) }}" method="POST"
                                          style="display:inline;" id="delSlot{{ $dispo->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" class="slot-btn del"
                                            onclick="glowConfirm('Delete this slot?','{{ $label }} {{ \Carbon\Carbon::parse($dispo->heure_debut)->format("H:i") }} → {{ \Carbon\Carbon::parse($dispo->heure_fin)->format("H:i") }}','Delete','fa-trash','red',function(){ document.getElementById('delSlot{{ $dispo->id }}').submit(); })">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="day-empty">
                        <span class="day-empty-text">No slots this day. </span>
                        <a href="{{ route('estheticienne.disponibilites.create') }}?jour={{ $num }}" class="day-empty-link">Add one →</a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
</div>
<script>
function showToast(msg,type){var t=document.getElementById('pg-toast');t.innerHTML='<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';t.style.background=type==='error'?'#ef4444':'#1a1a2e';t.style.display='flex';t.style.opacity='1';clearTimeout(t._x);t._x=setTimeout(function(){t.style.opacity='0';setTimeout(function(){t.style.display='none';},300);},4000);}
@if(session('success'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('success')),'success');});@endif
@if(session('error'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('error')),'error');});@endif
</script>
</x-app-layout>
