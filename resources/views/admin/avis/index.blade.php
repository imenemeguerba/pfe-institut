<x-app-layout>
<x-slot name="header">Reviews</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.avis-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

/* ── HERO ── */
.adm-hero { background:linear-gradient(135deg,#b480ff 0%,#c99ae8 45%,#d3aa95 100%); border-radius:20px; padding:28px 32px; margin-bottom:20px; position:relative; overflow:hidden; }
.adm-hero::before { content:''; position:absolute; top:-40px; right:-20px; width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,0.07); }
.adm-hero::after  { content:''; position:absolute; bottom:-50px; left:30px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,0.05); }
.adm-hero-inner { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.adm-hero-title { font-family:'Playfair Display',serif; font-size:26px; font-weight:800; color:white; }
.adm-hero-sub   { font-size:13px; color:rgba(255,255,255,0.75); margin-top:4px; }
.adm-hero-chips { display:flex; gap:10px; flex-wrap:wrap; }
.adm-chip { background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); border-radius:30px; padding:8px 16px; color:white; font-size:12px; font-weight:700; display:flex; align-items:center; gap:6px; }
.adm-chip-val { font-size:18px; font-weight:900; }
.adm-chip.orange { background:rgba(249,115,22,0.25); border-color:rgba(249,115,22,0.4); }
.adm-chip.green  { background:rgba(16,185,129,0.25); border-color:rgba(16,185,129,0.4); }

/* ── TABS + FILTERS ── */
.avis-header { background:white; border-radius:14px; border:1px solid #ede9fe; margin-bottom:16px; overflow:hidden; }
.avis-tabs { display:flex; border-bottom:1px solid #ede9fe; }
.avis-tab { flex:1; padding:12px 16px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.avis-tab:last-child { border-right:none; }
.avis-tab:hover { background:#fdf9ff; color:#b480ff; }
.avis-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.avis-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.avis-tab.active .avis-tab-count { background:#b480ff; color:white; }
.avis-tab-count.orange { background:rgba(249,115,22,0.1); color:#f97316; }
.avis-tab.pending.active .avis-tab-count { background:#f97316; color:white; }
.avis-filters { display:flex; align-items:center; gap:8px; padding:10px 16px; }
.avis-filters span { font-size:11px; color:#9ca3af; font-weight:600; }
.filter-chip { font-size:11px; font-weight:600; padding:5px 14px; border-radius:20px; text-decoration:none; border:1.5px solid #ede9fe; color:#6b7280; background:white; transition:all 0.2s; }
.filter-chip:hover { border-color:#b480ff; color:#b480ff; }
.filter-chip.active { background:#f5f0ff; color:#b480ff; border-color:#b480ff; }

/* ── REVIEW CARDS ── */
.avis-list { display:flex; flex-direction:column; gap:12px; }
.avis-card { background:white; border-radius:14px; border:1px solid #ede9fe; padding:18px 20px; transition:all 0.2s; }
.avis-card:hover { border-color:#c4b5fd; box-shadow:0 4px 16px rgba(180,128,255,0.08); }
.avis-card.en_attente { border-left:3px solid #f97316; }
.avis-card.publie     { border-left:3px solid #10b981; }
.avis-card.refuse     { border-left:3px solid #ef4444; }
.avis-top { display:flex; align-items:flex-start; justify-content:space-between; gap:14px; flex-wrap:wrap; }
.avis-left { flex:1; }
.avis-meta { display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-bottom:10px; }
.avis-av { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:11px; font-weight:700; flex-shrink:0; }
.avis-client { font-size:13px; font-weight:700; color:#1a1a2e; }
.avis-date   { font-size:11px; color:#9ca3af; }
.avis-type   { font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px; }
.avis-type.esthe { background:rgba(124,58,237,0.08); color:#7c3aed; }
.avis-type.inst  { background:rgba(236,72,153,0.08); color:#db2777; }
.stars { display:flex; align-items:center; gap:2px; margin-bottom:8px; }
.star { font-size:16px; }
.star.filled { color:#f59e0b; }
.star.empty  { color:#e5e7eb; }
.avis-note { font-size:12px; color:#6b7280; margin-left:6px; font-weight:600; }
.avis-comment { font-size:13px; color:#374151; line-height:1.6; font-style:italic; background:#fdf9ff; padding:10px 14px; border-radius:10px; border-left:3px solid rgba(180,128,255,0.3); }
.avis-no-comment { font-size:12px; color:#d1d5db; font-style:italic; }
.avis-refus-motif { font-size:11px; color:#ef4444; margin-top:8px; padding:8px 12px; background:#fff5f5; border-radius:8px; }

/* ── ACTIONS ── */
.avis-actions { display:flex; flex-direction:column; gap:8px; align-items:flex-end; min-width:120px; }
.avis-status { font-size:11px; font-weight:600; padding:5px 14px; border-radius:20px; display:inline-block; }
.avis-status.publie { background:rgba(16,185,129,0.1); color:#059669; }
.avis-status.refuse { background:rgba(239,68,68,0.1); color:#ef4444; }
.btn-approve { padding:8px 16px; border-radius:30px; background:rgba(16,185,129,0.1); color:#059669; font-size:12px; font-weight:700; border:1.5px solid rgba(16,185,129,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:5px; transition:all 0.2s; }
.btn-approve:hover { background:rgba(16,185,129,0.2); }
.btn-refuse-toggle { padding:8px 16px; border-radius:30px; background:rgba(239,68,68,0.06); color:#ef4444; font-size:12px; font-weight:700; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:5px; transition:all 0.2s; }
.btn-refuse-toggle:hover { background:rgba(239,68,68,0.12); }
.refuse-form { display:none; margin-top:6px; }
.refuse-form.open { display:block; }
.refuse-textarea { width:180px; padding:8px 10px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:12px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; resize:none; margin-bottom:6px; }
.refuse-textarea:focus { border-color:#ef4444; }
.btn-confirm-refus { width:100%; padding:7px; border-radius:8px; background:linear-gradient(to right,#ef4444,#f87171); color:white; font-size:11px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; }

/* ── EMPTY ── */
.avis-empty { background:white; border-radius:14px; border:1px solid #ede9fe; text-align:center; padding:64px 24px; }
.avis-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.avis-empty p { font-size:14px; color:#d1d5db; }
.avis-pagination { margin-top:16px; }
</style>

@php $totalAvis = $counts['en_attente'] + $counts['publies'] + $counts['refuses']; @endphp

<div class="avis-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Reviews</div>
                <div class="adm-hero-sub">Moderate client reviews before publication</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $counts['en_attente'] }}</span> Pending
                </div>
                <div class="adm-chip green">
                    <span class="adm-chip-val">{{ $counts['publies'] }}</span> Published
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $totalAvis }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS + FILTERS --}}
    <div class="avis-header">
        <div class="avis-tabs">
            @foreach([
                'en_attente' => ['label'=>'Pending',   'icon'=>'fa-clock',        'class'=>'pending'],
                'publies'    => ['label'=>'Published',  'icon'=>'fa-circle-check', 'class'=>''],
                'refuses'    => ['label'=>'Refused',    'icon'=>'fa-xmark',        'class'=>''],
            ] as $val => $info)
                <a href="{{ route('admin.avis.index', array_merge(request()->query(), ['filtre' => $val])) }}"
                   class="avis-tab {{ $info['class'] }} {{ $filtre === $val ? 'active' : '' }}">
                    <i class="fa-solid {{ $info['icon'] }}"></i>
                    {{ $info['label'] }}
                    <span class="avis-tab-count {{ ($val === 'en_attente' && $filtre !== 'en_attente') ? 'orange' : '' }}">
                        {{ $counts[$val] }}
                    </span>
                </a>
            @endforeach
        </div>
        <div class="avis-filters">
            <span>Filter:</span>
            <a href="{{ route('admin.avis.index', array_merge(request()->query(), ['type' => ''])) }}"
               class="filter-chip {{ !$type ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.avis.index', array_merge(request()->query(), ['type' => 'estheticienne'])) }}"
               class="filter-chip {{ $type === 'estheticienne' ? 'active' : '' }}">
                <i class="fa-solid fa-user-nurse" style="font-size:10px;"></i> Experts
            </a>
            <a href="{{ route('admin.avis.index', array_merge(request()->query(), ['type' => 'institut'])) }}"
               class="filter-chip {{ $type === 'institut' ? 'active' : '' }}">
                <i class="fa-solid fa-building" style="font-size:10px;"></i> Institute
            </a>
        </div>
    </div>

    {{-- REVIEWS --}}
    @if($avis->isEmpty())
        <div class="avis-empty">
            <i class="fa-solid fa-star"></i>
            <p>No reviews in this category.</p>
        </div>
    @else
        <div class="avis-list">
            @foreach($avis as $av)
                <div class="avis-card {{ $av->statut }}">
                    <div class="avis-top">
                        <div class="avis-left">
                            <div class="avis-meta">
                                @if($av->client->photo)
                                    <img src="{{ asset('storage/'.$av->client->photo) }}" class="avis-av" style="object-fit:cover;" alt="">
                                @else
                                    <div class="avis-av">{{ strtoupper(substr($av->client->prenom,0,1)) }}</div>
                                @endif
                                <div>
                                    <div class="avis-client">{{ $av->client->fullName() }}</div>
                                    <div class="avis-date">{{ $av->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                @if($av->type === 'estheticienne')
                                    <span class="avis-type esthe">
                                        <i class="fa-solid fa-user-nurse" style="font-size:9px;"></i>
                                        {{ $av->estheticienne?->fullName() }}
                                    </span>
                                @else
                                    <span class="avis-type inst">
                                        <i class="fa-solid fa-building" style="font-size:9px;"></i>
                                        Institute
                                    </span>
                                @endif
                            </div>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $av->note ? 'filled' : 'empty' }}">★</span>
                                @endfor
                                <span class="avis-note">{{ $av->note }}/5</span>
                            </div>
                            @if($av->commentaire)
                                <div class="avis-comment">"{{ $av->commentaire }}"</div>
                            @else
                                <div class="avis-no-comment">No comment</div>
                            @endif
                            @if($av->motif_refus)
                                <div class="avis-refus-motif">
                                    <i class="fa-solid fa-circle-xmark"></i> Refusal reason: {{ $av->motif_refus }}
                                </div>
                            @endif
                        </div>

                        {{-- ACTIONS --}}
                        <div class="avis-actions">
                            @if($av->statut === 'en_attente')
                                <form action="{{ route('admin.avis.approuver', $av) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-approve">
                                        <i class="fa-solid fa-check"></i> Approve
                                    </button>
                                </form>
                                <button type="button" class="btn-refuse-toggle"
                                        onclick="toggleRefus('{{ $av->id }}')">
                                    <i class="fa-solid fa-xmark"></i> Refuse
                                </button>
                                <div class="refuse-form" id="refus-{{ $av->id }}">
                                    <form action="{{ route('admin.avis.refuser', $av) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <textarea name="motif_refus" rows="3" required minlength="5" maxlength="500"
                                                  class="refuse-textarea" placeholder="Reason for refusal..."></textarea>
                                        <button type="submit" class="btn-confirm-refus">
                                            <i class="fa-solid fa-xmark"></i> Confirm Refusal
                                        </button>
                                    </form>
                                </div>
                            @elseif($av->statut === 'publie')
                                <span class="avis-status publie"><i class="fa-solid fa-check"></i> Published</span>
                            @else
                                <span class="avis-status refuse"><i class="fa-solid fa-xmark"></i> Refused</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="avis-pagination">{{ $avis->links() }}</div>
    @endif
</div>

<script>
function toggleRefus(id) {
    var form = document.getElementById('refus-' + id);
    form.classList.toggle('open');
}

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
