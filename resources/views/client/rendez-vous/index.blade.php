<x-app-layout>
<x-slot name="header">My Appointments</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

.rdvi-hero { position:relative; overflow:hidden; background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%); padding:60px 10% 100px; margin:-32px -24px 0; }
.rdvi-hero-bg { position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
.rdvi-hero-content { position:relative; z-index:2; text-align:center; }
.rdvi-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 18px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:18px; }
.rdvi-hero-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 20px rgba(0,0,0,0.15); margin-bottom:12px; line-height:1.2; }
.rdvi-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.rdvi-hero-sub { font-size:14px; color:rgba(255,255,255,0.92); margin-bottom:32px; }
.rdvi-hero-stats { display:flex; gap:12px; flex-wrap:wrap; justify-content:center; margin-top:24px; }
.rdvi-stat { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:30px; background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); backdrop-filter:blur(6px); }
.rdvi-stat-num { font-size:16px; font-weight:900; color:white; }
.rdvi-stat-lbl { font-size:12px; color:rgba(255,255,255,0.85); font-weight:600; }
.rdvi-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.rdvi-body { max-width:900px; margin:0 auto; padding:40px 24px 80px; }
.rdvi-tabs { display:flex; background:white; border-radius:20px; padding:6px; box-shadow:0 4px 20px rgba(180,128,255,0.08); border:1px solid #ede9fe; margin-bottom:32px; overflow:hidden; }
.rdvi-tab { flex:1; padding:10px 14px; border-radius:14px; text-align:center; font-size:12px; font-weight:600; text-decoration:none; color:#9ca3af; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:6px; cursor:pointer; }
.rdvi-tab:hover { color:#b480ff; }
.rdvi-tab.active { background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; box-shadow:0 4px 14px rgba(180,128,255,0.3); }

.rdvi-empty { text-align:center; padding:80px 24px; background:white; border-radius:24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); }
.rdvi-empty-icon { font-size:56px; color:#e9d8fd; margin-bottom:20px; display:block; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
.rdvi-empty h3 { font-size:22px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:8px; }
.rdvi-empty p  { font-size:14px; color:#6b7280; margin-bottom:24px; }
.rdvi-empty-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; text-decoration:none; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.3); }
.rdvi-empty-btn:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.4); }

.rdv-card { background:white; border-radius:24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.06); margin-bottom:16px; overflow:hidden; transition:all 0.3s cubic-bezier(0.175,0.885,0.32,1.275); opacity:0; animation:cardSlide 0.5s forwards; }
.rdv-card:nth-child(1){animation-delay:0s} .rdv-card:nth-child(2){animation-delay:.07s} .rdv-card:nth-child(3){animation-delay:.14s} .rdv-card:nth-child(4){animation-delay:.21s} .rdv-card:nth-child(5){animation-delay:.28s}
@keyframes cardSlide { from{opacity:0;transform:translateX(-20px);} to{opacity:1;transform:translateX(0);} }
.rdv-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(180,128,255,0.14); border-color:#c4b5fd; }
.rdv-card-top { display:flex; align-items:stretch; }
.rdv-card-stripe { width:5px; flex-shrink:0; background:linear-gradient(to bottom,#b480ff,#d3aa95); }
.rdv-card-stripe.green  { background:linear-gradient(to bottom,#10b981,#34d399); }
.rdv-card-stripe.blue   { background:linear-gradient(to bottom,#2563eb,#60a5fa); }
.rdv-card-stripe.red    { background:linear-gradient(to bottom,#ef4444,#fca5a5); }
.rdv-card-stripe.yellow { background:linear-gradient(to bottom,#f59e0b,#fcd34d); }
.rdv-card-body { flex:1; padding:20px 22px; }
.rdv-card-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:14px; flex-wrap:wrap; }
.rdv-card-date { font-size:17px; font-weight:800; color:#1a1a2e; text-transform:capitalize; }
.rdv-card-time { font-size:12px; color:#9ca3af; margin-top:3px; display:flex; align-items:center; gap:5px; }
.rdv-card-time i { color:#b480ff; font-size:10px; }
.rdv-card-info { display:flex; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:12px; }
.rdv-card-esthe { display:flex; align-items:center; gap:8px; }
.rdv-esthe-av { width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rdv-esthe-name { font-size:13px; font-weight:600; color:#1a1a2e; }
.rdv-tags { display:flex; flex-wrap:wrap; gap:5px; }
.rdv-tag { font-size:11px; padding:3px 10px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; font-weight:600; }
.rdv-card-footer { display:flex; align-items:center; justify-content:space-between; padding-top:12px; border-top:1px solid #faf8ff; flex-wrap:wrap; gap:8px; }
.rdv-price { font-size:18px; font-weight:800; color:#b480ff; }
.rdv-actions { display:flex; align-items:center; gap:8px; }
.rdv-btn-detail { display:inline-flex; align-items:center; gap:5px; padding:8px 16px; border-radius:20px; font-size:12px; font-weight:700; background:#fdf9ff; color:#b480ff; text-decoration:none; border:1.5px solid rgba(180,128,255,0.2); transition:all 0.2s; }
.rdv-btn-detail:hover { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; }
.rdv-btn-cancel { padding:8px 14px; border-radius:20px; font-size:12px; font-weight:600; background:white; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.rdv-btn-cancel:hover { background:#fff5f5; }

.rdv-group-card { background:white; border-radius:24px; border:1.5px solid rgba(180,128,255,0.2); box-shadow:0 4px 20px rgba(180,128,255,0.08); margin-bottom:16px; overflow:hidden; transition:all 0.3s; opacity:0; animation:cardSlide 0.5s forwards; }
.rdv-group-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(180,128,255,0.15); }
.rdv-group-header { padding:16px 22px; background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); border-bottom:1px solid rgba(180,128,255,0.1); display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap; }
.rdv-group-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#b480ff; margin-bottom:6px; display:flex; align-items:center; gap:5px; }
.rdv-group-date  { font-size:17px; font-weight:800; color:#1a1a2e; }
.rdv-group-time  { font-size:12px; color:#9ca3af; margin-top:2px; }
.rdv-group-price { font-size:22px; font-weight:900; color:#b480ff; text-align:right; }
.rdv-group-item  { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:14px 22px; border-bottom:1px solid #faf8ff; flex-wrap:wrap; }
.rdv-group-item:last-child { border-bottom:none; }

.rdvi-loading { text-align:center; padding:40px; color:#b480ff; font-size:13px; font-weight:600; }
.rdvi-loading i { font-size:24px; margin-bottom:8px; display:block; animation:spin 1s linear infinite; }
@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
.rdvi-pagination { margin-top:32px; display:flex; justify-content:center; }

@media(max-width:640px){ .rdvi-tabs{ flex-wrap:wrap; } .rdvi-tab{ flex:none; min-width:calc(50% - 4px); } }
</style>

{{-- HERO --}}
<div class="rdvi-hero">
    <div class="rdvi-hero-bg"></div>
    <div class="rdvi-hero-content">
        <div class="rdvi-hero-tag"><i class="fa-regular fa-calendar-check"></i> My Appointments</div>
        <h1 class="rdvi-hero-title">Your Beauty <span>Journey</span></h1>
        <p class="rdvi-hero-sub">Track and manage all your appointments in one place</p>
        <div class="rdvi-hero-stats">
            <div class="rdvi-stat">
                <i class="fa-regular fa-calendar-check" style="color:rgba(255,255,255,0.8);font-size:14px;"></i>
                <span class="rdvi-stat-num">{{ $paginator->total() }}</span>
                <span class="rdvi-stat-lbl">Appointments</span>
            </div>
        </div>
    </div>
    <div class="rdvi-wave"></div>
</div>

<div class="rdvi-body">

    <div class="rdvi-tabs" id="rdvi-tabs">
        @foreach(['a_venir'=>['Upcoming','fa-clock'],'passes'=>['Past','fa-clock-rotate-left'],'annules'=>['Cancelled','fa-xmark'],'tous'=>['All','fa-list']] as $val=>$info)
            <a href="{{ route('client.rendez-vous.index', ['filtre'=>$val]) }}"
               class="rdvi-tab {{ $filtre===$val?'active':'' }}"
               data-filtre="{{ $val }}">
                <i class="fa-solid {{ $info[1] }}"></i> {{ $info[0] }}
            </a>
        @endforeach
    </div>

    <div id="rdvi-content">
        @if($paginator->isEmpty())
            <div class="rdvi-empty">
                <i class="fa-regular fa-calendar-xmark rdvi-empty-icon"></i>
                <h3>No appointments yet</h3>
                <p>{{ $filtre==='a_venir' ? 'You have no upcoming appointments.' : 'No appointments in this category.' }}</p>
                <a href="{{ route('client.reservation.create') }}" class="rdvi-empty-btn">
                    <i class="fa-solid fa-plus"></i> Book an Appointment
                </a>
            </div>
        @else
            @foreach($paginator as $reservation)
                @php
                    $stripeClass = match(true) {
                        $reservation['type']==='simple' => match($reservation['rdv']->statut) {
                            'confirme'        => 'green',
                            'termine'         => 'blue',
                            'annule','refuse' => 'red',
                            default           => ''
                        },
                        default => ''
                    };
                @endphp

                @if($reservation['type']==='simple')
                    @php $rdv = $reservation['rdv']; @endphp
                    <div class="rdv-card">
                        <div class="rdv-card-top">
                            <div class="rdv-card-stripe {{ $stripeClass }}"></div>
                            <div class="rdv-card-body">
                                <div class="rdv-card-header">
                                    <div>
                                        <div class="rdv-card-date">{{ $rdv->date_debut->isoFormat('dddd D MMMM YYYY') }}</div>
                                        <div class="rdv-card-time">
                                            <i class="fa-regular fa-clock"></i>
                                            {{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}
                                            ({{ $rdv->duree_totale }} min)
                                        </div>
                                    </div>
                                    @include('client.rendez-vous._statut_badge', ['statut'=>$rdv->statut])
                                </div>
                                <div class="rdv-card-info">
                                    <div class="rdv-card-esthe">
                                        <div class="rdv-esthe-av">{{ strtoupper(substr($rdv->estheticienne->prenom,0,1)) }}</div>
                                        <div class="rdv-esthe-name">{{ $rdv->estheticienne->fullName() }}</div>
                                    </div>
                                </div>
                                <div class="rdv-tags">
                                    @foreach($rdv->services as $s)
                                        <span class="rdv-tag">{{ $s->nom }}</span>
                                    @endforeach
                                </div>
                                <div class="rdv-card-footer">
                                    <div class="rdv-price">{{ number_format($rdv->prix_final,0,',',' ') }} DA</div>
                                    <div class="rdv-actions">
                                        <a href="{{ route('client.rendez-vous.show', $rdv) }}" class="rdv-btn-detail">
                                            Details <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                        </a>
                                        @if(in_array($rdv->statut,['en_attente','confirme']) && $rdv->date_debut->isFuture())
                                            {{-- ✅ glowConfirm instead of confirm() --}}
                                            <form action="{{ route('client.rendez-vous.annuler', $rdv) }}"
                                                  method="POST" id="cancelRdv{{ $rdv->id }}">
                                                @csrf @method('PATCH')
                                                <button type="button" class="rdv-btn-cancel"
                                                    onclick="glowConfirm('Cancel this appointment?','{{ $rdv->date_debut->format('d/m/Y') }} at {{ $rdv->date_debut->format('H:i') }} will be cancelled.','Yes, cancel','fa-xmark','red',function(){ document.getElementById('cancelRdv{{ $rdv->id }}').submit(); })">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    @php
                        $rdvs        = $reservation['rdvs'];
                        $premierRdv  = $rdvs->first();
                        $dernierRdv  = $rdvs->last();
                        $prixTotal   = $rdvs->sum('prix_final');
                        $peutAnnuler = $rdvs->contains(fn($r) => in_array($r->statut,['en_attente','confirme']) && $r->date_debut->isFuture());
                    @endphp
                    <div class="rdv-group-card">
                        <div class="rdv-group-header">
                            <div>
                                <div class="rdv-group-label">
                                    <i class="fa-solid fa-link" style="font-size:10px;"></i>
                                    Group Booking — {{ $rdvs->count() }} appointments
                                </div>
                                <div class="rdv-group-date">{{ $premierRdv->date_debut->isoFormat('dddd D MMMM YYYY') }}</div>
                                <div class="rdv-group-time">{{ $premierRdv->date_debut->format('H:i') }} → {{ $dernierRdv->date_fin->format('H:i') }}</div>
                            </div>
                            <div>
                                <div class="rdv-group-price">{{ number_format($prixTotal,0,',',' ') }} DA</div>
                                @if($peutAnnuler)
                                    {{-- ✅ glowConfirm for group --}}
                                    <form action="{{ route('client.rendez-vous.annuler', $premierRdv) }}"
                                          method="POST" id="cancelGroup{{ $premierRdv->id }}"
                                          style="margin-top:8px;text-align:right;">
                                        @csrf @method('PATCH')
                                        <button type="button" class="rdv-btn-cancel"
                                            onclick="glowConfirm('Cancel entire group booking?','All {{ $rdvs->count() }} appointments will be cancelled.','Cancel All','fa-xmark','red',function(){ document.getElementById('cancelGroup{{ $premierRdv->id }}').submit(); })">
                                            Cancel All
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="rdv-group-items">
                            @foreach($rdvs as $rdv)
                                <div class="rdv-group-item">
                                    <div>
                                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:5px;">
                                            <div class="rdv-esthe-av" style="width:26px;height:26px;font-size:10px;">{{ strtoupper(substr($rdv->estheticienne->prenom,0,1)) }}</div>
                                            <span style="font-size:13px;font-weight:700;color:#1a1a2e;">{{ $rdv->estheticienne->fullName() }}</span>
                                            <span style="font-size:11px;color:#9ca3af;">{{ $rdv->date_debut->format('H:i') }} → {{ $rdv->date_fin->format('H:i') }}</span>
                                        </div>
                                        <div class="rdv-tags">
                                            @foreach($rdv->services as $s)<span class="rdv-tag">{{ $s->nom }}</span>@endforeach
                                        </div>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                                        @include('client.rendez-vous._statut_badge', ['statut'=>$rdv->statut])
                                        <a href="{{ route('client.rendez-vous.show', $rdv) }}" class="rdv-btn-detail">
                                            <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="rdvi-pagination">{{ $paginator->links() }}</div>
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
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('error')), 'error'); });
@endif

document.addEventListener('DOMContentLoaded', function() {
    var tabs    = document.querySelectorAll('.rdvi-tab');
    var content = document.getElementById('rdvi-content');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var url = tab.getAttribute('href');
            tabs.forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            history.pushState({ filtre: tab.getAttribute('data-filtre') }, '', url);
            content.innerHTML = '<div class="rdvi-loading"><i class="fa-solid fa-spinner"></i>Loading...</div>';
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r){ return r.text(); })
                .then(function(html){
                    var doc = new DOMParser().parseFromString(html, 'text/html');
                    var nc  = doc.getElementById('rdvi-content');
                    if (nc) content.innerHTML = nc.innerHTML;
                })
                .catch(function(){ window.location.href = url; });
        });
    });
    window.addEventListener('popstate', function(){ window.location.reload(); });
});
</script>

</x-app-layout>
