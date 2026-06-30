<x-app-layout>
<x-slot name="header">Book an Appointment</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
.res-page { min-height:100vh; background:#f8f5ff; padding:0; }
.res-hero { background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%); padding:40px 10%; position:relative; overflow:hidden; margin:-32px -24px 0; }
.res-hero::before { content:''; position:absolute; width:400px; height:400px; border-radius:50%; background:rgba(255,255,255,0.06); top:-150px; right:-80px; }
.res-hero::after  { content:''; position:absolute; width:250px; height:250px; border-radius:50%; background:rgba(255,255,255,0.05); bottom:-100px; left:100px; }
.res-hero h1 { font-size:32px; font-weight:800; color:white; margin-bottom:8px; position:relative; z-index:1; }
.res-hero p  { font-size:14px; color:rgba(255,255,255,0.85); position:relative; z-index:1; }
.res-hero-steps { display:flex; gap:12px; margin-top:24px; position:relative; z-index:1; flex-wrap:wrap; }
.res-step-chip { display:flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); border-radius:30px; padding:7px 14px; font-size:12px; font-weight:600; color:white; }
.res-step-num { width:22px; height:22px; border-radius:50%; background:rgba(255,255,255,0.9); color:#b480ff; font-size:11px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.res-body  { max-width:1100px; margin:0 auto; padding:32px 24px; }
.res-grid  { display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start; }
.filter-card { background:white; border-radius:20px; padding:20px 24px; border:1px solid #ede9fe; margin-bottom:20px; }
.filter-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.filter-title i { color:#b480ff; }
.filter-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px; margin-bottom:12px; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:5px; }
.f-input { width:100%; padding:10px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; transition:border-color 0.2s; font-family:'Plus Jakarta Sans',sans-serif; }
.f-input:focus { border-color:#b480ff; background:white; }
.f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center; background-size:14px; padding-right:30px; cursor:pointer; }
.filter-actions { display:flex; gap:8px; }
.btn-filter { padding:9px 20px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:12px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:6px; }
.btn-reset  { padding:9px 16px; border-radius:30px; background:white; color:#9ca3af; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none; }
.step-card { background:white; border-radius:20px; padding:24px; border:1px solid #ede9fe; margin-bottom:20px; transition:box-shadow 0.2s; }
.step-card:hover { box-shadow:0 8px 30px rgba(180,128,255,0.08); }
.step-header { display:flex; align-items:center; gap:12px; margin-bottom:20px; }
.step-badge { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.step-title { font-size:16px; font-weight:700; color:#1a1a2e; }
.step-sub   { font-size:12px; color:#9ca3af; margin-top:2px; }
.services-grid-res { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.service-option-res { border:2px solid #ede9fe; border-radius:14px; cursor:pointer; transition:all 0.2s; display:block; background:white; overflow:hidden; }
.service-option-res:hover   { border-color:#b480ff; background:#fdf9ff; }
.service-option-res.selected { border-color:#b480ff; background:rgba(180,128,255,0.04); }
.service-option-res input[type="checkbox"] { display:none; }
.svc-img-wrap { width:100%; height:110px; overflow:hidden; position:relative; background:linear-gradient(135deg,#b480ff,#d3aa95); flex-shrink:0; }
.svc-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform 0.3s ease; }
.service-option-res:hover .svc-img-wrap img { transform:scale(1.05); }
.svc-img-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:800; color:rgba(255,255,255,0.8); background:linear-gradient(135deg,#b480ff 0%,#c99ae8 60%,#d3aa95 100%); }
.svc-img-cat-badge { position:absolute; top:8px; left:8px; background:rgba(255,255,255,0.92); border-radius:20px; padding:3px 10px; font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#b480ff; }
.svc-img-check-badge { position:absolute; top:8px; right:8px; width:24px; height:24px; border-radius:50%; background:white; border:2px solid #ede9fe; display:flex; align-items:center; justify-content:center; transition:all 0.2s; }
.service-option-res.selected .svc-img-check-badge { background:#b480ff; border-color:#b480ff; }
.service-option-res.selected .svc-img-check-badge::after { content:'✓'; font-size:11px; color:white; font-weight:700; }
.svc-body { padding:12px 14px 14px; }
.svc-name { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
.svc-desc { font-size:11px; color:#9ca3af; line-height:1.5; margin-bottom:8px; }
.svc-footer { display:flex; justify-content:space-between; align-items:center; }
.svc-price { font-size:16px; font-weight:800; color:#b480ff; }
.svc-dur   { font-size:11px; color:#9ca3af; display:flex; align-items:center; gap:4px; }
.recap-box { background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); border:1.5px solid rgba(180,128,255,0.2); border-radius:14px; padding:16px; margin-top:16px; }
.recap-title { font-size:12px; font-weight:700; color:#b480ff; margin-bottom:10px; text-transform:uppercase; letter-spacing:0.5px; }
.recap-item { display:flex; justify-content:space-between; font-size:12px; color:#374151; margin-bottom:6px; }
.recap-totals { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:12px; padding-top:12px; border-top:1px solid rgba(180,128,255,0.15); }
.recap-total-item { text-align:center; }
.recap-total-label { font-size:10px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; }
.recap-total-value { font-size:20px; font-weight:800; color:#b480ff; margin-top:2px; }
.esthe-option-res { border:2px solid #ede9fe; border-radius:14px; padding:14px 16px; cursor:pointer; transition:all 0.2s; display:block; margin-bottom:10px; background:white; }
.esthe-option-res:hover { border-color:#b480ff; }
.esthe-option-res.selected { border-color:#b480ff; background:rgba(180,128,255,0.04); }
.esthe-option-res.auto { border-color:rgba(180,128,255,0.3); background:rgba(180,128,255,0.04); }
.esthe-option-res.auto.selected { border-color:#b480ff; background:rgba(180,128,255,0.08); }
.esthe-top { display:flex; align-items:center; gap:12px; }
.esthe-av { width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.esthe-name { font-size:14px; font-weight:700; color:#1a1a2e; }
.esthe-exp  { font-size:11px; color:#9ca3af; margin-top:2px; }
.esthe-spec { font-size:11px; color:#6b7280; margin-top:4px; font-style:italic; }
.esthe-radio { width:20px; height:20px; border-radius:50%; border:2px solid #ede9fe; background:white; display:flex; align-items:center; justify-content:center; margin-left:auto; flex-shrink:0; }
.esthe-option-res.selected .esthe-radio { background:#b480ff; border-color:#b480ff; }
.esthe-option-res.selected .esthe-radio::after { content:''; width:8px; height:8px; border-radius:50%; background:white; display:block; }
.state-placeholder { text-align:center; padding:32px; color:#c4b5fd; }
.state-placeholder i { font-size:32px; margin-bottom:10px; display:block; }
.state-placeholder p { font-size:13px; color:#d1d5db; }
.state-loading { text-align:center; padding:24px; color:#b480ff; font-size:13px; }
.state-loading i { font-size:24px; display:block; margin-bottom:8px; animation:spin 1s linear infinite; }
@keyframes spin { to { transform:rotate(360deg); } }
.state-empty { background:rgba(249,115,22,0.04); border:1px solid rgba(249,115,22,0.2); border-left:3px solid #f97316; border-radius:10px; padding:14px 16px; font-size:13px; color:#9a3412; }
.split-banner { background:rgba(37,99,235,0.05); border:1px solid rgba(37,99,235,0.2); border-left:3px solid #2563eb; border-radius:10px; padding:14px 16px; margin-bottom:12px; }
.split-banner-title { font-size:13px; font-weight:700; color:#1e40af; margin-bottom:4px; }
.split-banner-sub   { font-size:12px; color:#3b82f6; }
.split-groupe-card  { border:1.5px solid rgba(180,128,255,0.2); border-radius:12px; padding:14px 16px; margin-bottom:8px; background:#fdf9ff; }
.split-rdv-label    { font-size:10px; font-weight:700; color:#b480ff; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; }
.split-rdv-esthe    { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:6px; }
.split-tags         { display:flex; flex-wrap:wrap; gap:4px; }
.split-tag          { font-size:10px; padding:2px 8px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; }
.split-price        { font-size:14px; font-weight:700; color:#b480ff; }
.creneau-jour { margin-bottom:16px; }
.creneau-jour-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:10px; display:flex; align-items:center; gap:6px; }
.creneau-jour-title i { color:#b480ff; font-size:11px; }
.creneaux-grid-res { display:flex; flex-wrap:wrap; gap:8px; }
.creneau-btn-res { padding:9px 16px; border-radius:30px; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; background:white; color:#374151; cursor:pointer; transition:all 0.2s; font-family:'Plus Jakarta Sans',sans-serif; }
.creneau-btn-res:hover  { border-color:#b480ff; color:#b480ff; background:#fdf9ff; }
.creneau-btn-res.active { background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border-color:transparent; box-shadow:0 4px 12px rgba(180,128,255,0.3); }
.info-textarea { width:100%; padding:12px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; resize:vertical; min-height:80px; font-family:'Plus Jakarta Sans',sans-serif; transition:border-color 0.2s; }
.info-textarea:focus { border-color:#b480ff; background:white; }
.promo-wrap { display:flex; gap:10px; margin-top:14px; }
.promo-input { flex:1; padding:11px 14px; border-radius:12px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; outline:none; text-transform:uppercase; font-family:'Plus Jakarta Sans',sans-serif; transition:border-color 0.2s; }
.promo-input:focus { border-color:#b480ff; }
.res-summary { position:sticky; top:90px; background:white; border-radius:20px; padding:24px; border:1px solid #ede9fe; box-shadow:0 8px 30px rgba(180,128,255,0.1); }
.summary-title { font-size:15px; font-weight:800; color:#1a1a2e; margin-bottom:20px; display:flex; align-items:center; gap:8px; }
.summary-title i { color:#b480ff; }
.summary-section { margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #faf8ff; }
.summary-section:last-child { border-bottom:none; margin-bottom:0; padding-bottom:0; }
.summary-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#c4b5fd; margin-bottom:8px; }
.summary-empty { font-size:12px; color:#d1d5db; font-style:italic; }
.summary-service-item { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
.summary-service-name  { font-size:12px; color:#374151; font-weight:500; }
.summary-service-price { font-size:12px; font-weight:700; color:#b480ff; }
.summary-esthe { font-size:13px; font-weight:600; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.summary-esthe i { color:#b480ff; }
.summary-slot  { font-size:13px; font-weight:600; color:#1a1a2e; display:flex; align-items:center; gap:8px; }
.summary-slot i { color:#b480ff; }
.summary-total { background:linear-gradient(135deg,rgba(180,128,255,0.08),rgba(211,170,149,0.05)); border-radius:12px; padding:14px; margin-bottom:16px; }
.summary-total-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
.summary-total-row:last-child { margin-bottom:0; }
.summary-total-label { font-size:12px; color:#6b7280; }
.summary-total-value { font-size:12px; font-weight:600; color:#374151; }
.summary-total-final { font-size:18px; font-weight:800; color:#b480ff; }
.btn-submit-res { width:100%; padding:14px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:15px; font-weight:800; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center; gap:10px; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.3); }
.btn-submit-res:hover { opacity:0.9; transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.4); }
.btn-cancel-link { display:block; text-align:center; margin-top:12px; font-size:12px; color:#9ca3af; text-decoration:none; }
.btn-cancel-link:hover { color:#b480ff; }
.alert-err { background:#fff5f5; border:1px solid #fca5a5; color:#991b1b; padding:14px 16px; border-radius:14px; font-size:13px; margin-bottom:20px; }
@media(max-width:900px) { .res-grid{ grid-template-columns:1fr; } .res-summary{ position:static; } }
@media(max-width:640px) { .services-grid-res{ grid-template-columns:1fr; } .filter-grid{ grid-template-columns:1fr; } }
</style>

<div class="res-page">

    {{-- HERO --}}
    <div class="res-hero">
        <h1>Book an Appointment</h1>
        <p>Choose your services, your expert and your time slot in a few simple steps.</p>
        <div class="res-hero-steps">
            <div class="res-step-chip"><div class="res-step-num">1</div> Services</div>
            <div class="res-step-chip"><div class="res-step-num">2</div> Expert</div>
            <div class="res-step-chip"><div class="res-step-num">3</div> Time Slot</div>
            <div class="res-step-chip"><div class="res-step-num">4</div> Details</div>
        </div>
    </div>

    <div class="res-body">

        @if(session('error'))
            <div class="alert-err"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-err">
                <strong><i class="fa-solid fa-circle-xmark"></i> Please fix the following errors:</strong>
                <ul style="margin-top:6px;margin-left:16px;">
                    @foreach($errors->all() as $err)<li style="margin-top:4px;">{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="res-grid">

            {{-- LEFT COLUMN --}}
            <div class="res-left">

                {{-- FILTER --}}
                <div class="filter-card">
                    <div class="filter-title"><i class="fa-solid fa-sliders"></i> Filter Services</div>
                    <form id="filterForm">
                        <div class="filter-grid">
                            <div>
                                <label class="f-label">Search</label>
                                <input type="text" name="search" value="{{ $search }}" placeholder="Service name..." class="f-input">
                            </div>
                            <div>
                                <label class="f-label">Category</label>
                                <select name="categorie" class="f-input f-select">
                                    <option value="">All categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="f-label">Max Price (DA)</label>
                                <input type="number" name="prix_max" value="{{ $prixMax }}" min="0" step="500" placeholder="e.g. 5000" class="f-input">
                            </div>
                        </div>
                        <div class="filter-actions">
    <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
    <button type="button" class="btn-reset" id="resetFilterBtn" style="display:none;"><i class="fa-solid fa-xmark"></i> Reset</button>
</div>
                    </form>
                </div>

                {{-- MAIN FORM --}}
                <form method="POST" action="{{ route('client.reservation.store') }}" id="reservation-form">
                    @csrf

                    {{-- STEP 1 : SERVICES --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">1</div>
                            <div>
                                <div class="step-title">Choose your services</div>
                                <div class="step-sub">Select one or more services</div>
                            </div>
                        </div>

                        @if($services->isEmpty())
                            <div class="state-empty"><i class="fa-solid fa-triangle-exclamation"></i> No services available with these filters.</div>
                        @else
                            <div class="services-grid-res">
                                @foreach($services as $service)
                                    <label class="service-option-res {{ in_array($service->id, $servicesPreSelectionnes) ? 'selected' : '' }}" id="label-svc-{{ $service->id }}">
                                        <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                               data-prix="{{ $service->prix }}"
                                               data-duree="{{ $service->duree }}"
                                               data-nom="{{ $service->nom }}"
                                               {{ in_array($service->id, $servicesPreSelectionnes) ? 'checked' : '' }}
                                               class="service-checkbox">
                                        <div class="svc-img-wrap">
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->nom }}">
                                            @else
                                                <div class="svc-img-placeholder">{{ mb_strtoupper(mb_substr($service->nom, 0, 2)) }}</div>
                                            @endif
                                            <div class="svc-img-cat-badge">{{ $service->category->nom }}</div>
                                            <div class="svc-img-check-badge"></div>
                                        </div>
                                        <div class="svc-body">
                                            <div class="svc-name">{{ $service->nom }}</div>
                                            @if($service->description)
                                                <div class="svc-desc">{{ Str::limit($service->description, 70) }}</div>
                                            @endif
                                            <div class="svc-footer">
                                                <div class="svc-price">{{ number_format($service->prix, 0, ',', ' ') }} DA</div>
                                                <div class="svc-dur"><i class="fa-regular fa-clock" style="font-size:10px;"></i> {{ $service->dureeFormatee() }}</div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div id="recap-services" class="recap-box" style="display:none;">
                                <div class="recap-title">Selected Services</div>
                                <ul id="liste-services-choisis" style="list-style:none; margin-bottom:0;"></ul>
                                <div class="recap-totals">
                                    <div class="recap-total-item">
                                        <div class="recap-total-label">Total Duration</div>
                                        <div class="recap-total-value" id="duree-totale">0 min</div>
                                    </div>
                                    <div class="recap-total-item">
                                        <div class="recap-total-label">Total Price</div>
                                        <div class="recap-total-value" id="prix-total">0 DA</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- STEP 2 : EXPERT --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">2</div>
                            <div>
                                <div class="step-title">Choose your expert</div>
                                <div class="step-sub">Or let us assign one automatically</div>
                            </div>
                        </div>
                        <div id="esthe-placeholder" class="state-placeholder">
                            <i class="fa-solid fa-spa"></i>
                            <p>Please select at least one service first</p>
                        </div>
                        <div id="esthe-loading" style="display:none;" class="state-loading">
                            <i class="fa-solid fa-circle-notch"></i> Looking for available experts...
                        </div>
                        <div id="esthe-empty" style="display:none;" class="state-empty">
                            <i class="fa-solid fa-triangle-exclamation"></i> No expert available for these services.
                        </div>
                        <div id="esthe-content" style="display:none;"></div>
                        <input type="hidden" name="estheticienne_id" id="estheticienne-id" value="">
                    </div>

                    {{-- STEP 3 : TIME SLOT --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">3</div>
                            <div>
                                <div class="step-title">Choose a time slot</div>
                                <div class="step-sub">Available slots for the next 15 days</div>
                            </div>
                        </div>
                        <div id="creneaux-placeholder" class="state-placeholder">
                            <i class="fa-regular fa-calendar"></i>
                            <p>Please choose an expert first</p>
                        </div>
                        <div id="creneaux-loading" style="display:none;" class="state-loading">
                            <i class="fa-solid fa-circle-notch"></i> Loading available slots...
                        </div>
                        <div id="creneaux-empty" style="display:none;" class="state-empty">
                            <i class="fa-solid fa-triangle-exclamation"></i> No slots available in the next 15 days.
                        </div>
                        <div id="creneaux-content" style="display:none;"></div>
                        <input type="hidden" name="date"  id="date-selected"  value="">
                        <input type="hidden" name="heure" id="heure-selected" value="">
                    </div>

                    {{-- STEP 4 : DETAILS --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">4</div>
                            <div>
                                <div class="step-title">Additional Information</div>
                                <div class="step-sub">Notes and promo code (optional)</div>
                            </div>
                        </div>
                        <label class="f-label">Special request or note</label>
                        <textarea name="note_client" id="note_client" rows="3" maxlength="500"
                                  class="info-textarea"
                                  placeholder="e.g. fragrance allergy, first visit...">{{ old('note_client') }}</textarea>
                        <div class="promo-wrap">
                            <input type="text" name="code_promo" id="code_promo" value="{{ old('code_promo') }}"
                                   placeholder="Promo code (optional)" class="promo-input">
                        </div>
                    </div>

                </form>
            </div>

            {{-- RIGHT : SUMMARY --}}
            <div>
                <div class="res-summary">
                    <div class="summary-title"><i class="fa-solid fa-receipt"></i> Summary</div>

                    <div class="summary-section">
                        <div class="summary-label">Services</div>
                        <div id="sum-services"><div class="summary-empty">No service selected</div></div>
                    </div>

                    <div class="summary-section">
                        <div class="summary-label">Expert</div>
                        <div id="sum-esthe"><div class="summary-empty">Not selected</div></div>
                    </div>

                    <div class="summary-section">
                        <div class="summary-label">Date & Time</div>
                        <div id="sum-slot"><div class="summary-empty">Not selected</div></div>
                    </div>

                    <div class="summary-total" id="sum-total" style="display:none;">
                        <div class="summary-total-row">
                            <div class="summary-total-label">Duration</div>
                            <div class="summary-total-value" id="sum-duree">—</div>
                        </div>
                        <div class="summary-total-row">
                            <div class="summary-total-label">Total Price</div>
                            <div class="summary-total-final" id="sum-prix">—</div>
                        </div>
                    </div>

                    <button type="submit" form="reservation-form" class="btn-submit-res">
                        <i class="fa-solid fa-calendar-check"></i> Confirm Appointment
                    </button>
                    <a href="{{ route('landingpage') }}" class="btn-cancel-link">Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken    = "{{ csrf_token() }}";
    const form         = document.getElementById('reservation-form');
    const dateInput    = document.getElementById('date-selected');
    const heureInput   = document.getElementById('heure-selected');
    const estheIdInput = document.getElementById('estheticienne-id');

    const modeInput    = document.createElement('input');
    modeInput.type = 'hidden'; modeInput.name = 'mode'; modeInput.id = 'mode-input'; modeInput.value = 'simple';
    form.appendChild(modeInput);

    const sumServices = document.getElementById('sum-services');
    const sumEsthe    = document.getElementById('sum-esthe');
    const sumSlot     = document.getElementById('sum-slot');
    const sumTotal    = document.getElementById('sum-total');
    const sumDuree    = document.getElementById('sum-duree');
    const sumPrix     = document.getElementById('sum-prix');

    let currentSplitGroupes = null;

    form.addEventListener('submit', function(e) {
        const choisis = Array.from(document.querySelectorAll('.service-checkbox:checked'));
        if (choisis.length === 0) { e.preventDefault(); alert('Please select at least one service.'); return; }
        if (!dateInput.value || !heureInput.value) { e.preventDefault(); alert('Please choose a date and time slot.'); return; }
    });

    function getServicesChoisis() { return Array.from(document.querySelectorAll('.service-checkbox:checked')); }

    function formatDuree(min) {
        if (min < 60) return min + ' min';
        const h = Math.floor(min/60), m = min % 60;
        return m === 0 ? h + 'h' : h + 'h' + String(m).padStart(2,'0');
    }

    function clearGroupesInputs() { document.querySelectorAll('[data-groupe-input]').forEach(el => el.remove()); }

    function hideEsthe() {
        ['esthe-placeholder','esthe-loading','esthe-empty','esthe-content'].forEach(id => document.getElementById(id).style.display='none');
    }
    function resetEsthePlaceholder() {
        hideEsthe(); document.getElementById('esthe-placeholder').style.display='';
        estheIdInput.value = '';
        sumEsthe.innerHTML = '<div class="summary-empty">Not selected</div>';
    }
    function hideCreneaux() {
        ['creneaux-placeholder','creneaux-loading','creneaux-empty','creneaux-content'].forEach(id => document.getElementById(id).style.display='none');
    }
    function resetCreneauxPlaceholder() {
        hideCreneaux(); document.getElementById('creneaux-placeholder').style.display='';
        dateInput.value = ''; heureInput.value = '';
        sumSlot.innerHTML = '<div class="summary-empty">Not selected</div>';
    }

    function updateRecap() {
        const choisis = getServicesChoisis();

        document.querySelectorAll('.service-option-res').forEach(label => {
            const cb = label.querySelector('.service-checkbox');
            label.classList.toggle('selected', cb.checked);
        });

        if (choisis.length === 0) {
            document.getElementById('recap-services').style.display = 'none';
            sumServices.innerHTML = '<div class="summary-empty">No service selected</div>';
            sumTotal.style.display = 'none';
            resetEsthePlaceholder();
            resetCreneauxPlaceholder();
            return;
        }

        let duree = 0, prix = 0;
        const listeEl = document.getElementById('liste-services-choisis');
        listeEl.innerHTML = '';
        let sumHtml = '';

        choisis.forEach(cb => {
            duree += parseInt(cb.dataset.duree);
            prix  += parseInt(cb.dataset.prix);
            const li = document.createElement('li');
            li.className = 'recap-item';
            li.innerHTML = `<span>${cb.dataset.nom}</span><span style="color:#b480ff;font-weight:700;">${parseInt(cb.dataset.prix).toLocaleString('fr-FR')} DA</span>`;
            listeEl.appendChild(li);
            sumHtml += `<div class="summary-service-item"><span class="summary-service-name">${cb.dataset.nom}</span><span class="summary-service-price">${parseInt(cb.dataset.prix).toLocaleString('fr-FR')} DA</span></div>`;
        });

        document.getElementById('duree-totale').textContent = formatDuree(duree);
        document.getElementById('prix-total').textContent   = prix.toLocaleString('fr-FR') + ' DA';
        document.getElementById('recap-services').style.display = '';
        sumServices.innerHTML = sumHtml;
        sumDuree.textContent  = formatDuree(duree);
        sumPrix.textContent   = prix.toLocaleString('fr-FR') + ' DA';
        sumTotal.style.display = '';

        chargerEsthes();
    }

    document.querySelectorAll('.service-checkbox').forEach(cb => cb.addEventListener('change', updateRecap));

    async function chargerEsthes() {
        const serviceIds = getServicesChoisis().map(cb => cb.value);
        if (serviceIds.length === 0) { resetEsthePlaceholder(); return; }

        hideEsthe();
        document.getElementById('esthe-loading').style.display = '';
        estheIdInput.value = ''; modeInput.value = 'simple'; currentSplitGroupes = null; clearGroupesInputs();
        hideCreneaux(); resetCreneauxPlaceholder();

        try {
            const fd = new FormData();
            fd.append('_token', csrfToken);
            serviceIds.forEach(id => fd.append('service_ids[]', id));

            const r    = await fetch("{{ route('client.reservation.esthes-competentes') }}", { method:'POST', headers:{'Accept':'application/json'}, body:fd });
            const data = await r.json();
            hideEsthe();

            if (data.mode === 'impossible') {
                const el = document.getElementById('esthe-empty');
                el.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> ${data.error || 'No expert available for all these services.'}`;
                el.style.display = '';
                return;
            }

            const estheContent = document.getElementById('esthe-content');
            estheContent.innerHTML = '';

            if (data.mode === 'simple') {
                modeInput.value = 'simple';
                if (!data.esthes || data.esthes.length === 0) { document.getElementById('esthe-empty').style.display=''; return; }

                const autoLabel = document.createElement('div');
                autoLabel.className = 'esthe-option-res auto selected';
                autoLabel.innerHTML = `<div class="esthe-top"><div class="esthe-av" style="background:linear-gradient(135deg,rgba(180,128,255,0.3),rgba(211,170,149,0.3));color:#b480ff;font-size:18px;">🎲</div><div style="flex:1;"><div class="esthe-name">Automatic Assignment</div><div class="esthe-exp">${data.esthes.length} expert(s) available</div></div><div class="esthe-radio"></div></div>`;
                estheContent.appendChild(autoLabel);

                data.esthes.forEach(esthe => {
                    const label = document.createElement('div');
                    label.className = 'esthe-option-res';
                    const initials = esthe.nom.split(' ').map(n=>n[0]).join('').toUpperCase().slice(0,2);
                    const avatarHtml = esthe.photo
                        ? `<img src="${esthe.photo}" class="esthe-av" style="object-fit:cover;" alt="">`
                        : `<div class="esthe-av">${initials}</div>`;
                    label.innerHTML = `<div class="esthe-top">${avatarHtml}<div style="flex:1;"><div class="esthe-name">${esthe.nom}</div><div class="esthe-exp">${esthe.experience} year(s) of experience</div>${esthe.specialites?`<div class="esthe-spec">${esthe.specialites}</div>`:''}</div><a href="/client/estheticiennes/${esthe.id}" style="padding:5px 12px;border-radius:20px;background:rgba(180,128,255,0.08);color:#b480ff;font-size:11px;font-weight:600;text-decoration:none;border:1.5px solid rgba(180,128,255,0.2);margin-right:8px;flex-shrink:0;">Profile</a><div class="esthe-radio"></div></div>`;
                    estheContent.appendChild(label);
                });

                estheContent.style.display = '';

                const allLabels = estheContent.querySelectorAll('.esthe-option-res');
                const estheList = [null, ...data.esthes.map(e=>e.id)];
                allLabels.forEach((label, idx) => {
                    label.addEventListener('click', (e) => {
                        if (e.target.closest('a')) return;
                        allLabels.forEach(l => l.classList.remove('selected'));
                        label.classList.add('selected');
                        estheIdInput.value = estheList[idx] || '';
                        const name = idx === 0 ? 'Automatic Assignment' : data.esthes[idx-1].nom;
                        sumEsthe.innerHTML = `<div class="summary-esthe"><i class="fa-solid fa-user-nurse"></i> ${name}</div>`;
                        chargerCreneaux();
                    });
                });

                // Auto-sélection si esthéticienne pré-sélectionnée
let defaultIdx = 0; // 0 = auto
if (_preSelectedEsthe) {
    const found = data.esthes.findIndex(e => e.id === _preSelectedEsthe);
    if (found !== -1) defaultIdx = found + 1; // +1 car index 0 = auto
}

allLabels.forEach(l => l.classList.remove('selected'));
allLabels[defaultIdx].classList.add('selected');
estheIdInput.value = estheList[defaultIdx] || '';
const name = defaultIdx === 0 ? 'Automatic Assignment' : data.esthes[defaultIdx-1].nom;
sumEsthe.innerHTML = `<div class="summary-esthe"><i class="fa-solid fa-user-nurse"></i> ${name}</div>`;
chargerCreneaux();
return;
            }

            if (data.mode === 'split') {
                modeInput.value = 'split';
                currentSplitGroupes = data.groupes;

                const banner = document.createElement('div');
                banner.className = 'split-banner';
                banner.innerHTML = `<div class="split-banner-title"><i class="fa-solid fa-link"></i> Group Booking</div><div class="split-banner-sub">Your booking will be split into ${data.groupes.length} consecutive appointments.</div>`;
                estheContent.appendChild(banner);

                let sumEstheHtml = '';
                data.groupes.forEach((groupe, index) => {
                    const addHidden = (name, value) => {
                        const inp = document.createElement('input');
                        inp.type='hidden'; inp.name=name; inp.value=value; inp.setAttribute('data-groupe-input','1');
                        form.appendChild(inp);
                    };
                    addHidden(`groupes[${index}][esthe_id]`, groupe.esthe.id);
                    groupe.services.forEach(s => addHidden(`groupes[${index}][service_ids][]`, s.id));

                    const card = document.createElement('div');
                    card.className = 'split-groupe-card';
                    card.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:flex-start;"><div><div class="split-rdv-label">Appointment ${index+1}</div><div class="split-rdv-esthe"><i class="fa-solid fa-user-nurse" style="color:#b480ff;margin-right:5px;"></i>${groupe.esthe.nom}</div><div class="split-tags">${groupe.services.map(s=>`<span class="split-tag">${s.nom}</span>`).join('')}</div></div><div style="text-align:right;"><div class="split-price">${groupe.prix.toLocaleString('fr-FR')} DA</div><div style="font-size:11px;color:#9ca3af;">${formatDuree(groupe.duree)}</div></div></div>`;
                    estheContent.appendChild(card);
                    sumEstheHtml += `<div class="summary-service-item"><span class="summary-service-name">${groupe.esthe.nom}</span><span class="summary-service-price">Appt ${index+1}</span></div>`;
                });

                estheContent.style.display = '';
                sumEsthe.innerHTML = sumEstheHtml;
                chargerCreneaux();
            }

        } catch(e) {
            hideEsthe(); document.getElementById('esthe-empty').style.display='';
            console.error(e);
        }
    }

    async function chargerCreneaux() {
        const serviceIds = getServicesChoisis().map(cb => cb.value);
        if (serviceIds.length === 0) { resetCreneauxPlaceholder(); return; }

        hideCreneaux();
        document.getElementById('creneaux-loading').style.display = '';
        dateInput.value = ''; heureInput.value = '';
        sumSlot.innerHTML = '<div class="summary-empty">Not selected</div>';

        try {
            const fd = new FormData();
            fd.append('_token', csrfToken);
            serviceIds.forEach(id => fd.append('service_ids[]', id));

            if (currentSplitGroupes) {
                fd.append('mode','split');
                currentSplitGroupes.forEach((groupe, index) => {
                    fd.append(`split_groupes[${index}][esthe_id]`, groupe.esthe.id);
                    fd.append(`split_groupes[${index}][duree]`,    groupe.duree);
                });
            } else {
                fd.append('mode','simple');
                if (estheIdInput.value) fd.append('estheticienne_id', estheIdInput.value);
            }

            const r    = await fetch("{{ route('client.reservation.creneaux') }}", { method:'POST', headers:{'Accept':'application/json'}, body:fd });
            const data = await r.json();
            hideCreneaux();

            if (!data.jours || data.jours.length === 0) { document.getElementById('creneaux-empty').style.display=''; return; }

            const creneauxContent = document.getElementById('creneaux-content');
            creneauxContent.innerHTML = '';

            data.jours.forEach(jour => {
                const block = document.createElement('div');
                block.className = 'creneau-jour';

                let label = jour.date_label;
                if (jour.is_today)         label = "Today — " + label;
                else if (jour.is_tomorrow) label = "Tomorrow — " + label;

                block.innerHTML = `<div class="creneau-jour-title"><i class="fa-regular fa-calendar"></i> ${label}</div><div class="creneaux-grid-res"></div>`;

                const grid = block.querySelector('.creneaux-grid-res');
                jour.creneaux.forEach(creneau => {
                    const btn = document.createElement('button');
                    btn.type = 'button'; btn.textContent = creneau;
                    btn.dataset.date = jour.date; btn.dataset.heure = creneau;
                    btn.className = 'creneau-btn-res';

                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.creneau-btn-res').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        dateInput.value  = btn.dataset.date;
                        heureInput.value = btn.dataset.heure;
                        sumSlot.innerHTML = `<div class="summary-slot"><i class="fa-regular fa-calendar"></i> ${label}</div><div class="summary-slot" style="margin-top:4px;"><i class="fa-regular fa-clock"></i> ${creneau}</div>`;
                    });

                    grid.appendChild(btn);
                });

                creneauxContent.appendChild(block);
            });

            creneauxContent.style.display = '';

        } catch(e) {
            hideCreneaux(); document.getElementById('creneaux-empty').style.display='';
            console.error(e);
        }
    }

   // ── INIT ─────────────────────────────────────────────────
    @if(isset($estheticiennePreSelectionnee) && $estheticiennePreSelectionnee)
        var _preSelectedEsthe = {{ $estheticiennePreSelectionnee }};
    @else
        var _preSelectedEsthe = null;
    @endif

    // ── FILTER AJAX ──────────────────────────────────────────
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var fd  = new FormData(this);
        var url = new URL('{{ route("client.reservation.create") }}');
        fd.forEach(function(v, k) { if (v) url.searchParams.set(k, v); });
        url.searchParams.set('ajax', '1');

        fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var stepCard = document.querySelector('.step-card');
            var oldGrid  = stepCard.querySelector('.services-grid-res');
            var oldEmpty = stepCard.querySelector('.state-empty');
            var target   = oldGrid || oldEmpty;
            if (target) target.outerHTML = data.html;
            document.querySelectorAll('.service-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateRecap);
            });
            updateRecap();
        });
    });

    updateRecap();
    function updateResetFilterBtn() {
    var s = document.querySelector('#filterForm [name="search"]').value;
    var c = document.querySelector('#filterForm [name="categorie"]').value;
    var p = document.querySelector('#filterForm [name="prix_max"]').value;
    document.getElementById('resetFilterBtn').style.display = (s || c || p) ? '' : 'none';
}

document.getElementById('resetFilterBtn').addEventListener('click', function() {
    document.querySelector('#filterForm [name="search"]').value = '';
    document.querySelector('#filterForm [name="categorie"]').value = '';
    document.querySelector('#filterForm [name="prix_max"]').value = '';
    updateResetFilterBtn();
    document.getElementById('filterForm').dispatchEvent(new Event('submit'));
});

document.getElementById('filterForm').addEventListener('input', updateResetFilterBtn);

}); // fin DOMContentLoaded


</script>

</x-app-layout>
