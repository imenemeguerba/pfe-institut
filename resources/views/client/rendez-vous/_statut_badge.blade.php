@php
$config = [
    'en_attente' => ['bg:rgba(249,115,22,0.1)',  'color:#f97316', '⏳', 'Pending'],
    'confirme'   => ['bg:rgba(16,185,129,0.1)',  'color:#059669', '✅', 'Confirmed'],
    'termine'    => ['bg:rgba(37,99,235,0.1)',   'color:#2563eb', '🏁', 'Completed'],
    'annule'     => ['bg:rgba(239,68,68,0.1)',   'color:#ef4444', '✕',  'Cancelled'],
    'refuse'     => ['bg:rgba(239,68,68,0.1)',   'color:#ef4444', '✕',  'Refused'],
];
$c = $config[$statut] ?? ['bg:rgba(107,114,128,0.1)', 'color:#6b7280', '•', $statut];
@endphp
<span style="display:inline-flex;align-items:center;gap:5px;padding:5px 14px;border-radius:30px;font-size:11px;font-weight:700;{{ $c[0] }};{{ $c[1] }};border:1.5px solid currentColor;opacity:0.9;">
    {{ $c[2] }} {{ $c[3] }}
</span>