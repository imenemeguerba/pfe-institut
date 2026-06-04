<x-app-layout>
<x-slot name="header">My Absences</x-slot>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
.ind-wrap{margin:-24px;padding:0;background:#f8f5ff;}
.ind-hero{position:relative;overflow:hidden;padding:44px 32px 90px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.ind-hero-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.1) 1px,transparent 1px);background-size:28px 28px;}
.ind-hero-orb1{position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.1),transparent 70%);top:-80px;right:-60px;animation:orbF 7s ease-in-out infinite alternate;}
.ind-hero-orb2{position:absolute;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);bottom:-40px;left:80px;animation:orbF 10s ease-in-out 2s infinite alternate;}
@keyframes orbF{from{transform:scale(1);}to{transform:scale(1.12) translate(15px,-10px);}}
.ind-hero-content{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.ind-hero-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 16px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.35);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:14px;}
.ind-hero-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:white;line-height:1.2;margin-bottom:6px;}
.ind-hero-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);text-decoration:underline;text-decoration-color:rgba(255,255,255,0.35);text-underline-offset:4px;}
.ind-hero-sub{font-size:13px;color:rgba(255,255,255,0.8);}
.btn-hero-add{display:inline-flex;align-items:center;gap:7px;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:700;background:white;color:#b480ff;text-decoration:none;transition:all 0.2s;box-shadow:0 4px 16px rgba(0,0,0,0.12);}
.btn-hero-add:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,0.18);}
.ind-wave{position:absolute;bottom:-2px;left:0;right:0;height:60px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 60'%3E%3Cpath fill='%23f8f5ff' d='M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}
.ind-body{padding:24px;}
.ind-tabs{display:flex;background:white;border-radius:14px;border:1px solid #ede9fe;overflow:hidden;margin-bottom:16px;box-shadow:0 2px 10px rgba(180,128,255,0.04);}
.ind-tab{flex:1;padding:11px 12px;text-align:center;text-decoration:none;font-size:12px;font-weight:600;color:#6b7280;border-right:1px solid #ede9fe;transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:6px;}
.ind-tab:last-child{border-right:none;}
.ind-tab:hover{background:#fdf9ff;color:#b480ff;}
.ind-tab.active{background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06));color:#b480ff;font-weight:700;}
.ind-table-card{background:white;border-radius:16px;border:1px solid #ede9fe;overflow:hidden;box-shadow:0 2px 10px rgba(180,128,255,0.05);}
.ind-table{width:100%;border-collapse:collapse;}
.ind-table thead th{padding:12px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#9ca3af;background:#fdf9ff;border-bottom:1px solid #ede9fe;}
.ind-table thead th.tr{text-align:right;}
.ind-table tbody tr{border-bottom:1px solid #faf8ff;transition:background 0.15s;}
.ind-table tbody tr:last-child{border-bottom:none;}
.ind-table tbody tr:hover{background:#fdf9ff;}
.ind-table td{padding:14px 16px;vertical-align:middle;}
.ind-table td.tr{text-align:right;}
.period-from{font-size:13px;font-weight:700;color:#1a1a2e;}
.period-to{font-size:11px;color:#9ca3af;margin-top:2px;}
.type-badge{font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;display:inline-block;}
.type-badge.conge{background:rgba(59,130,246,0.1);color:#2563eb;}
.type-badge.maladie{background:rgba(239,68,68,0.1);color:#ef4444;}
.type-badge.formation{background:rgba(124,58,237,0.1);color:#7c3aed;}
.type-badge.autre{background:rgba(107,114,128,0.1);color:#6b7280;}
.motif-text{font-size:12px;color:#6b7280;}
.ind-actions{display:flex;align-items:center;gap:8px;justify-content:flex-end;}
.act-btn{padding:6px 12px;border-radius:20px;font-size:11px;font-weight:700;cursor:pointer;border:none;font-family:inherit;text-decoration:none;display:inline-flex;align-items:center;gap:4px;transition:all 0.2s;}
.act-btn.edit{background:#f5f0ff;color:#7c3aed;border:1px solid #ede9fe;}
.act-btn.edit:hover{background:#ede9fe;}
.act-btn.del{background:white;color:#ef4444;border:1px solid rgba(239,68,68,0.2);}
.act-btn.del:hover{background:#fff5f5;}
.past-tag{font-size:11px;color:#d1d5db;font-style:italic;}
.ind-empty{text-align:center;padding:56px 24px;}
.ind-empty i{font-size:40px;color:#e9d8fd;margin-bottom:12px;display:block;}
.ind-empty p{font-size:13px;color:#d1d5db;}
.ind-pagination{padding:16px 20px;border-top:1px solid #faf8ff;}
</style>
<div class="ind-wrap">
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="ind-hero">
    <div class="ind-hero-dots"></div><div class="ind-hero-orb1"></div><div class="ind-hero-orb2"></div>
    <div class="ind-hero-content">
        <div>
            <div class="ind-hero-tag"><i class="fa-solid fa-ban"></i> Absences</div>
            <div class="ind-hero-title">My <span>Absences</span></div>
            <div class="ind-hero-sub">Vacations, sick leave, training and other absences.</div>
        </div>
        <a href="{{ route('estheticienne.indisponibilites.create') }}" class="btn-hero-add">
            <i class="fa-solid fa-plus"></i> New Absence
        </a>
    </div>
    <div class="ind-wave"></div>
</div>
<div class="ind-body">
    <div class="ind-tabs">
        @foreach(['a_venir'=>['Upcoming','fa-clock'],'passees'=>['Past','fa-clock-rotate-left'],'toutes'=>['All','fa-list']] as $val=>$info)
            <a href="{{ route('estheticienne.indisponibilites.index', ['filtre'=>$val]) }}"
               class="ind-tab {{ $filtre===$val?'active':'' }}">
                <i class="fa-solid {{ $info[1] }}"></i> {{ $info[0] }}
            </a>
        @endforeach
    </div>
    <div class="ind-table-card">
        @if($indisponibilites->isEmpty())
            <div class="ind-empty">
                <i class="fa-solid fa-calendar-xmark"></i>
                <p>No absences in this category.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="ind-table">
                    <thead>
                        <tr>
                            <th>Period</th><th>Type</th><th>Reason</th><th class="tr">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($indisponibilites as $indispo)
                        @php $labels=['conge'=>'🏖️ Vacation','maladie'=>'🤒 Sick','formation'=>'🎓 Training','autre'=>'📌 Other']; @endphp
                            <tr>
                                <td>
                                    <div class="period-from">{{ $indispo->date_debut->format('d/m/Y') }}</div>
                                    <div class="period-to">→ {{ $indispo->date_fin->format('d/m/Y') }}</div>
                                </td>
                                <td>
                                    <span class="type-badge {{ $indispo->type }}">{{ $labels[$indispo->type] ?? $indispo->type }}</span>
                                </td>
                                <td><div class="motif-text">{{ $indispo->motif ?? '—' }}</div></td>
                                <td class="tr">
                                    <div class="ind-actions">
                                        @if($indispo->date_fin->isFuture())
                                            <a href="{{ route('estheticienne.indisponibilites.edit', $indispo) }}" class="act-btn edit">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('estheticienne.indisponibilites.destroy', $indispo) }}"
                                                  method="POST" style="display:inline;" id="delIndispo{{ $indispo->id }}">
                                                @csrf @method('DELETE')
                                                <button type="button" class="act-btn del"
                                                    onclick="glowConfirm('Delete this absence?','{{ $labels[$indispo->type] ?? $indispo->type }}: {{ $indispo->date_debut->format("d/m/Y") }}','Delete','fa-trash','red',function(){ document.getElementById('delIndispo{{ $indispo->id }}').submit(); })">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="past-tag">Past</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ind-pagination">{{ $indisponibilites->links() }}</div>
        @endif
    </div>
</div>
</div>
<script>
function showToast(msg,type){var t=document.getElementById('pg-toast');t.innerHTML='<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';t.style.background=type==='error'?'#ef4444':'#1a1a2e';t.style.display='flex';t.style.opacity='1';clearTimeout(t._x);t._x=setTimeout(function(){t.style.opacity='0';setTimeout(function(){t.style.display='none';},300);},4000);}
@if(session('success'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('success')),'success');});@endif
@if(session('error'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('error')),'error');});@endif
</script>
</x-app-layout>
