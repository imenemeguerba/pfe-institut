<x-app-layout>
<x-slot name="header">Institute Settings</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.inst-wrap  { margin:-24px; padding:32px; background:#f8f5ff; }
.inst-inner { max-width:860px; margin:0 auto; }

/* ── PAGE HEADER ── */
.inst-page-header { display:flex; align-items:center; gap:16px; margin-bottom:28px; }
.inst-page-icon   { width:52px; height:52px; border-radius:16px; background:linear-gradient(135deg,#b480ff,#d3aa95); display:flex; align-items:center; justify-content:center; color:white; font-size:22px; flex-shrink:0; }
.inst-page-header h1 { font-family:'Playfair Display',serif; font-size:22px; font-weight:800; color:#1a1a2e; margin-bottom:2px; }
.inst-page-header p  { font-size:13px; color:#9ca3af; }

/* ── CARDS ── */
.inst-card { background:white; border-radius:20px; border:1.5px solid rgba(180,128,255,0.1); margin-bottom:20px; overflow:hidden; }
.inst-card-header { display:flex; align-items:center; gap:14px; padding:20px 28px; border-bottom:1px solid #f7f5ff; }
.inst-card-icon   { width:36px; height:36px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:15px; }
.inst-card-title  { font-size:14px; font-weight:700; color:#1a1a2e; }
.inst-card-body   { padding:24px 28px; }

/* ── FORM ── */
.f-grid   { display:grid; gap:16px; }
.f-grid-2 { grid-template-columns:1fr 1fr; }
.f-grid-3 { grid-template-columns:1fr 1fr 1fr; }
.f-group  { }
.f-label  { display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:8px; }
.f-input  { width:100%; padding:12px 16px; border-radius:12px; border:1.5px solid #ede9ff; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:all 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.08); }
.f-input::placeholder { color:#c4b5fd; }
textarea.f-input { resize:vertical; min-height:90px; }
.f-hint  { font-size:11px; color:#c4b5fd; margin-top:5px; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }

/* ── LOGO ── */
.logo-section { display:flex; align-items:center; gap:20px; }
.logo-preview { width:80px; height:80px; border-radius:16px; object-fit:contain; border:2px solid rgba(180,128,255,0.2); background:#fdf9ff; padding:4px; }
.logo-placeholder { width:80px; height:80px; border-radius:16px; background:rgba(180,128,255,0.08); display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:28px; border:2px dashed rgba(180,128,255,0.2); }
.logo-upload-right { flex:1; }
.logo-drop { border:2px dashed rgba(180,128,255,0.25); border-radius:12px; padding:16px 20px; background:#fdf9ff; cursor:pointer; display:flex; align-items:center; gap:12px; transition:all 0.2s; }
.logo-drop:hover { border-color:#b480ff; background:rgba(180,128,255,0.04); }
.logo-drop i { font-size:20px; color:#b480ff; }
.logo-drop-text h4 { font-size:13px; font-weight:600; color:#1a1a2e; }
.logo-drop-text p  { font-size:11px; color:#9ca3af; }
.logo-drop input { display:none; }
.btn-del-logo { display:inline-flex; align-items:center; gap:5px; margin-top:8px; padding:7px 14px; border-radius:20px; background:#fff5f5; color:#ef4444; border:1.5px solid rgba(239,68,68,0.2); font-size:11px; font-weight:700; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.btn-del-logo:hover { background:rgba(239,68,68,0.1); }

/* ── MAP ── */
.map-wrap { border-radius:14px; overflow:hidden; border:1.5px solid rgba(180,128,255,0.15); margin-top:16px; }
.map-placeholder { height:200px; background:rgba(180,128,255,0.05); display:flex; flex-direction:column; align-items:center; justify-content:center; color:#c4b5fd; border-radius:14px; border:2px dashed rgba(180,128,255,0.2); gap:8px; }
.map-placeholder i { font-size:36px; }
.map-placeholder p { font-size:13px; }
.map-tip { background:rgba(180,128,255,0.06); border-radius:10px; padding:12px 16px; font-size:12px; color:#7c6d9e; line-height:1.7; margin-bottom:16px; border-left:3px solid #b480ff; }
.map-tip a { color:#b480ff; text-decoration:none; font-weight:600; }

/* ── HORAIRES ── */
.horaire-row { display:grid; grid-template-columns:140px 1fr 1fr; gap:12px; align-items:center; padding:12px 16px; border-radius:12px; background:#fdf9ff; border:1.5px solid rgba(180,128,255,0.08); margin-bottom:8px; transition:border-color 0.2s; }
.horaire-row:hover { border-color:rgba(180,128,255,0.2); }
.horaire-check { display:flex; align-items:center; gap:10px; }
.horaire-check input[type="checkbox"] { width:18px; height:18px; accent-color:#b480ff; cursor:pointer; }
.horaire-check label { font-size:13px; font-weight:600; color:#1a1a2e; cursor:pointer; }
.horaire-hint { font-size:11px; color:#9ca3af; margin-top:8px; text-align:center; }

/* ── SOCIAL ── */
.social-row { display:flex; align-items:center; gap:12px; margin-bottom:12px; }
.social-icon { width:40px; height:40px; border-radius:10px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:16px; }
.social-icon.fb { background:rgba(24,119,242,0.1); color:#1877f2; }
.social-icon.ig { background:rgba(225,48,108,0.1); color:#e1306c; }
.social-icon.wa { background:rgba(37,211,102,0.1); color:#25d366; }

/* ── SETTINGS ── */
.setting-row { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-radius:12px; background:#fdf9ff; border:1.5px solid rgba(180,128,255,0.08); margin-bottom:10px; }
.setting-row-info h4 { font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.setting-row-info p  { font-size:11px; color:#9ca3af; }
.setting-input { width:120px; padding:10px 14px; border-radius:10px; border:1.5px solid #ede9ff; background:white; font-size:14px; font-weight:700; color:#b480ff; text-align:center; font-family:'Plus Jakarta Sans',sans-serif; outline:none; }
.setting-input:focus { border-color:#b480ff; }

/* ── SAVE ── */
.save-bar { display:flex; justify-content:flex-end; padding:20px 28px; border-top:1px solid #f7f5ff; }
.btn-save { padding:13px 36px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; border:none; cursor:pointer; transition:all 0.2s; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:10px; }
.btn-save:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 20px rgba(180,128,255,0.35); }

@media (max-width:768px) {
    .f-grid-2,.f-grid-3 { grid-template-columns:1fr; }
    .horaire-row { grid-template-columns:1fr; }
}
</style>

<div class="inst-wrap">
<div class="inst-inner">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- PAGE HEADER --}}
    <div class="inst-page-header">
        <div class="inst-page-icon"><i class="fa-solid fa-building"></i></div>
        <div>
            <h1>Institut Settings</h1>
            <p>Manage your institute information and preferences</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.institut.update') }}" enctype="multipart/form-data">
        @csrf @method('PATCH')

        {{-- IDENTITY --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-solid fa-id-card"></i></div>
                <span class="inst-card-title">Identity</span>
            </div>
            <div class="inst-card-body">
                <div class="f-grid" style="margin-bottom:16px;">
                    <div class="f-group">
                        <label class="f-label" for="nom">Institute Name *</label>
                        <input class="f-input" id="nom" name="nom" type="text" value="{{ old('nom', $institut->nom) }}" required>
                        @error('nom')<p class="f-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="f-group" style="margin-bottom:20px;">
                    <label class="f-label" for="description">Description</label>
                    <textarea class="f-input" id="description" name="description" maxlength="2000">{{ old('description', $institut->description) }}</textarea>
                </div>

            </div>
        </div>

        {{-- CONTACT --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-solid fa-address-book"></i></div>
                <span class="inst-card-title">Contact Information</span>
            </div>
            <div class="inst-card-body">
                <div class="f-grid f-grid-2" style="margin-bottom:16px;">
                    <div class="f-group">
                        <label class="f-label" for="email">Email *</label>
                        <input class="f-input" id="email" name="email" type="email" value="{{ old('email', $institut->email) }}" required>
                        @error('email')<p class="f-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="telephone">Phone *</label>
                        <input class="f-input" id="telephone" name="telephone" type="tel" value="{{ old('telephone', $institut->telephone) }}" required>
                    </div>
                </div>
                <div class="f-group" style="margin-bottom:16px;">
                    <label class="f-label" for="adresse">Address *</label>
                    <input class="f-input" id="adresse" name="adresse" type="text" value="{{ old('adresse', $institut->adresse) }}" required>
                </div>
                <div class="f-grid f-grid-2">
                    <div class="f-group">
                        <label class="f-label" for="ville">City</label>
                        <input class="f-input" id="ville" name="ville" type="text" value="{{ old('ville', $institut->ville) }}">
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="code_postal">Postal Code</label>
                        <input class="f-input" id="code_postal" name="code_postal" type="text" value="{{ old('code_postal', $institut->code_postal) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- GPS --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-solid fa-location-dot"></i></div>
                <span class="inst-card-title">GPS Location</span>
            </div>
            <div class="inst-card-body">
                <div class="map-tip">
                    Enter your institute GPS coordinates.
                    <a href="https://www.google.com/maps" target="_blank">Search on Google Maps →</a>
                    Right-click on the location → "What's here?" to copy the coordinates.
                </div>
                <div class="f-grid f-grid-2" style="margin-bottom:16px;">
                    <div class="f-group">
                        <label class="f-label" for="latitude">Latitude</label>
                        <input class="f-input" id="latitude" name="latitude" type="text" value="{{ old('latitude', $institut->latitude) }}" placeholder="36.7538">
                        <p class="f-hint">Example: 36.7538 (Algiers)</p>
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="longitude">Longitude</label>
                        <input class="f-input" id="longitude" name="longitude" type="text" value="{{ old('longitude', $institut->longitude) }}" placeholder="3.0588">
                        <p class="f-hint">Example: 3.0588 (Algiers)</p>
                    </div>
                </div>
                @if($institut->latitude && $institut->longitude)
                    <div class="map-wrap">
                        <iframe src="https://www.openstreetmap.org/export/embed.html?bbox={{ $institut->longitude-0.01 }},{{ $institut->latitude-0.01 }},{{ $institut->longitude+0.01 }},{{ $institut->latitude+0.01 }}&layer=mapnik&marker={{ $institut->latitude }},{{ $institut->longitude }}"
                            width="100%" height="260" style="border:0;" loading="lazy"></iframe>
                    </div>
                @else
                    <div class="map-placeholder">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <p>Map will appear after entering GPS coordinates</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- SOCIAL --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-solid fa-share-nodes"></i></div>
                <span class="inst-card-title">Social Media</span>
            </div>
            <div class="inst-card-body">
                <div class="social-row">
                    <div class="social-icon fb"><i class="fa-brands fa-facebook-f"></i></div>
                    <input class="f-input" name="facebook" type="url" value="{{ old('facebook', $institut->facebook) }}" placeholder="https://facebook.com/...">
                </div>
                <div class="social-row">
                    <div class="social-icon ig"><i class="fa-brands fa-instagram"></i></div>
                    <input class="f-input" name="instagram" type="url" value="{{ old('instagram', $institut->instagram) }}" placeholder="https://instagram.com/...">
                </div>
                <div class="social-row">
                    <div class="social-icon wa"><i class="fa-brands fa-whatsapp"></i></div>
                    <input class="f-input" name="whatsapp" type="text" value="{{ old('whatsapp', $institut->whatsapp) }}" placeholder="+213...">
                </div>
            </div>
        </div>

        {{-- HORAIRES --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-regular fa-clock"></i></div>
                <span class="inst-card-title">Opening Hours</span>
            </div>
            <div class="inst-card-body">
                @php
                    $jours = ['lundi'=>'Monday','mardi'=>'Tuesday','mercredi'=>'Wednesday','jeudi'=>'Thursday','vendredi'=>'Friday','samedi'=>'Saturday','dimanche'=>'Sunday'];
                    $horairesActuels = $institut->horaires_ouverture ?? [];
                @endphp
                @foreach($jours as $key => $label)
                    @php $j = $horairesActuels[$key] ?? ['ouvert'=>false,'matin'=>'','apres_midi'=>'']; @endphp
                    <div class="horaire-row">
                        <div class="horaire-check">
                            <input type="checkbox" id="h_{{ $key }}" name="horaires_{{ $key }}_ouvert" value="1" {{ ($j['ouvert']??false) ? 'checked' : '' }}>
                            <label for="h_{{ $key }}">{{ $label }}</label>
                        </div>
                        <input class="f-input" type="text" name="horaires_{{ $key }}_matin" value="{{ $j['matin']??''  }}" placeholder="09:00–12:00">
                        <input class="f-input" type="text" name="horaires_{{ $key }}_apres_midi" value="{{ $j['apres_midi']??''  }}" placeholder="13:00–18:00">
                    </div>
                @endforeach
                <p class="horaire-hint">Uncheck a day to mark it as closed</p>
            </div>
        </div>

        {{-- SETTINGS --}}
        <div class="inst-card">
            <div class="inst-card-header">
                <div class="inst-card-icon"><i class="fa-solid fa-sliders"></i></div>
                <span class="inst-card-title">Settings</span>
            </div>
            <div class="inst-card-body">
                <div class="setting-row">
                    <div class="setting-row-info"><h4>VAT Rate (%)</h4><p>Applied to invoices and orders</p></div>
                    <input class="setting-input" type="number" step="0.01" name="taux_tva" value="{{ old('taux_tva', $institut->taux_tva) }}" required>
                </div>
                <div class="setting-row">
                    <div class="setting-row-info"><h4>Medium Threshold</h4><p>Appointments/day → orange indicator</p></div>
                    <input class="setting-input" type="number" min="1" name="seuil_affluence_moyen" value="{{ old('seuil_affluence_moyen', $institut->seuil_affluence_moyen) }}" required>
                </div>
                <div class="setting-row">
                    <div class="setting-row-info"><h4>High Threshold</h4><p>Appointments/day → red indicator</p></div>
                    <input class="setting-input" type="number" min="1" name="seuil_affluence_eleve" value="{{ old('seuil_affluence_eleve', $institut->seuil_affluence_eleve) }}" required>
                </div>
            </div>
        </div>

        {{-- SAVE --}}
        <div class="save-bar" style="background:white;border-radius:20px;border:1.5px solid rgba(180,128,255,0.1);">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>

    </form>
</div>
</div>

<script>
function deleteLogo() {
    document.getElementById('supprimerLogo').value = '1';
    document.getElementById('logoPreview').style.display = 'none';
    document.getElementById('logoPlaceholder').style.display = 'flex';
    var btn = document.getElementById('btnDelLogo');
    if (btn) btn.style.display = 'none';
    var label = document.getElementById('logoLabel');
    if (label) label.textContent = 'Upload logo';
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
