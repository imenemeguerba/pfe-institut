<x-app-layout>
<x-slot name="header">Messages</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.msg-wrap { margin:-24px; padding:24px; background:#f8f5ff; }

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
.adm-chip.blue   { background:rgba(59,130,246,0.3); border-color:rgba(59,130,246,0.5); }
.adm-chip.orange { background:rgba(249,115,22,0.25); border-color:rgba(249,115,22,0.4); }

/* ── TABS ── */
.msg-tabs { display:flex; background:white; border-radius:14px; border:1px solid #ede9fe; overflow:hidden; margin-bottom:16px; }
.msg-tab { flex:1; padding:11px 12px; text-align:center; text-decoration:none; font-size:12px; font-weight:500; color:#6b7280; border-right:1px solid #ede9fe; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; }
.msg-tab:last-child { border-right:none; }
.msg-tab:hover { background:#fdf9ff; color:#b480ff; }
.msg-tab.active { background:linear-gradient(135deg,rgba(180,128,255,0.1),rgba(211,170,149,0.06)); color:#b480ff; font-weight:700; }
.msg-tab-count { font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; background:rgba(180,128,255,0.1); color:#b480ff; }
.msg-tab.active .msg-tab-count { background:#b480ff; color:white; }
.msg-tab-count.blue { background:rgba(59,130,246,0.1); color:#2563eb; }

/* ── TABLE ── */
.msg-table-card { background:white; border-radius:16px; border:1px solid #ede9fe; overflow:hidden; }
.msg-table { width:100%; border-collapse:collapse; }
.msg-table thead th { padding:12px 16px; text-align:left; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#9ca3af; background:#fdf9ff; border-bottom:1px solid #ede9fe; }
.msg-table thead th.tc { text-align:center; }
.msg-table tbody tr { border-bottom:1px solid #faf8ff; transition:background 0.15s; }
.msg-table tbody tr:last-child { border-bottom:none; }
.msg-table tbody tr:hover { background:#fdf9ff; }
.msg-table tbody tr.unread { background:rgba(59,130,246,0.03); border-left:3px solid #3b82f6; }
.msg-table td { padding:14px 16px; vertical-align:middle; }
.msg-table td.tc { text-align:center; }
.msg-sender  { font-size:13px; font-weight:700; color:#1a1a2e; }
.msg-role    { font-size:10px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; }
.msg-subject { font-size:13px; font-weight:600; color:#1a1a2e; }
.msg-subject.bold { font-weight:800; }
.msg-preview { font-size:11px; color:#9ca3af; margin-top:2px; }
.msg-date    { font-size:11px; color:#9ca3af; }
.msg-status  { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-block; }
.msg-status.repondu    { background:rgba(16,185,129,0.1); color:#059669; }
.msg-status.nouveau    { background:rgba(59,130,246,0.1); color:#2563eb; }
.msg-status.en_attente { background:rgba(249,115,22,0.1); color:#f97316; }
.msg-link { font-size:12px; font-weight:600; color:#b480ff; text-decoration:none; white-space:nowrap; }
.msg-link:hover { color:#9333ea; }
.msg-empty { text-align:center; padding:64px 24px; }
.msg-empty i { font-size:40px; color:#e9d8fd; margin-bottom:12px; display:block; }
.msg-empty p { font-size:14px; color:#d1d5db; }
.msg-pagination { padding:16px 20px; border-top:1px solid #faf8ff; }
</style>

<div class="msg-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="adm-hero">
        <div class="adm-hero-inner">
            <div>
                <div class="adm-hero-title">Messages</div>
                <div class="adm-hero-sub">Contact messages from clients and experts</div>
            </div>
            <div class="adm-hero-chips">
                <div class="adm-chip blue">
                    <span class="adm-chip-val">{{ $counts['non_lus'] }}</span> Unread
                </div>
                <div class="adm-chip orange">
                    <span class="adm-chip-val">{{ $counts['en_attente'] }}</span> No Reply
                </div>
                <div class="adm-chip">
                    <span class="adm-chip-val">{{ $counts['tous'] }}</span> Total
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="msg-tabs">
        @foreach([
            'tous'       => ['label'=>'All',      'icon'=>'fa-list'],
            'non_lus'    => ['label'=>'Unread',   'icon'=>'fa-circle',      'count_class'=>'blue'],
            'en_attente' => ['label'=>'No Reply', 'icon'=>'fa-clock'],
            'repondus'   => ['label'=>'Replied',  'icon'=>'fa-circle-check'],
        ] as $val => $info)
            <a href="{{ route('admin.messages-contact.index', ['filtre' => $val]) }}"
               class="msg-tab {{ $filtre === $val ? 'active' : '' }}">
                <i class="fa-solid {{ $info['icon'] }}"></i>
                {{ $info['label'] }}
                <span class="msg-tab-count {{ isset($info['count_class']) && $filtre !== $val ? $info['count_class'] : '' }}">
                    {{ $counts[$val] }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- TABLE --}}
    <div class="msg-table-card">
        @if($messages->isEmpty())
            <div class="msg-empty">
                <i class="fa-solid fa-envelope-open"></i>
                <p>No messages in this category.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="msg-table">
                    <thead>
                        <tr>
                            <th>Sender</th><th>Subject</th><th>Date</th>
                            <th class="tc">Status</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                            <tr class="{{ !$msg->lu ? 'unread' : '' }}">
                                <td>
                                    <div class="msg-sender">{{ $msg->user->fullName() }}</div>
                                    <div class="msg-role">{{ $msg->user->role }}</div>
                                </td>
                                <td>
                                    <div class="msg-subject {{ !$msg->lu ? 'bold' : '' }}">{{ $msg->sujet }}</div>
                                    <div class="msg-preview">{{ Str::limit($msg->message, 60) }}</div>
                                </td>
                                <td><div class="msg-date">{{ $msg->created_at->format('d/m/Y H:i') }}</div></td>
                                <td class="tc">
                                    @if($msg->estRepondu())
                                        <span class="msg-status repondu"><i class="fa-solid fa-check" style="font-size:9px;"></i> Replied</span>
                                    @elseif(!$msg->lu)
                                        <span class="msg-status nouveau"><i class="fa-solid fa-circle" style="font-size:7px;"></i> New</span>
                                    @else
                                        <span class="msg-status en_attente"><i class="fa-solid fa-clock" style="font-size:9px;"></i> Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.messages-contact.show', $msg) }}" class="msg-link">
                                        View <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="msg-pagination">{{ $messages->links() }}</div>
        @endif
    </div>
</div>

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
