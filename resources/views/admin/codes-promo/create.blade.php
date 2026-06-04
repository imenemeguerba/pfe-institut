<x-app-layout>
<x-slot name="header">New Promo Code</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
.form-wrap { margin: -24px; padding: 24px; background: #f8f5ff; }
.form-inner { max-width: 680px; margin: 0 auto; }

.form-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.form-top h1 { font-size: 18px; font-weight: 800; color: #1a1a2e; }
.btn-back { font-size: 12px; color: #b480ff; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; padding: 8px 14px; border-radius: 30px; border: 1.5px solid #ede9fe; background: white; }

.form-card { background: white; border-radius: 16px; border: 1px solid #ede9fe; padding: 24px; margin-bottom: 16px; }
.form-card-title { font-size: 13px; font-weight: 700; color: #1a1a2e; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
.form-card-title i { color: #b480ff; }

.f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
.f-group { margin-bottom: 16px; }
.f-group:last-child { margin-bottom: 0; }
.f-label { display: block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #9ca3af; margin-bottom: 6px; }
.f-input { width: 100%; padding: 11px 14px; border-radius: 10px; border: 1.5px solid #ede9fe; background: #fdf9ff; font-size: 13px; color: #1a1a2e; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; transition: border-color 0.2s; }
.f-input:focus { border-color: #b480ff; background: white; box-shadow: 0 0 0 3px rgba(180,128,255,0.07); }
textarea.f-input { resize: vertical; min-height: 80px; }
.f-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px; cursor: pointer; }
.f-mono { font-family: monospace; font-size: 15px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
.f-error { font-size: 11px; color: #ef4444; margin-top: 5px; }
.f-hint  { font-size: 11px; color: #c4b5fd; margin-top: 4px; }

/* Code preview */
.code-preview { display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 10px; background: linear-gradient(135deg, rgba(180,128,255,0.12), rgba(211,170,149,0.08)); border: 1.5px solid rgba(180,128,255,0.2); font-family: monospace; font-size: 16px; font-weight: 800; color: #7c3aed; letter-spacing: 2px; margin-top: 8px; min-width: 140px; min-height: 38px; }

/* Apply to options */
.apply-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
.apply-option { display: none; }
.apply-label { display: flex; flex-direction: column; align-items: center; gap: 6px; padding: 14px 10px; border-radius: 12px; border: 1.5px solid #ede9fe; background: #fdf9ff; cursor: pointer; transition: all 0.2s; text-align: center; }
.apply-label i { font-size: 20px; color: #c4b5fd; }
.apply-label span { font-size: 12px; font-weight: 600; color: #374151; }
.apply-option:checked + .apply-label { border-color: #b480ff; background: rgba(180,128,255,0.06); }
.apply-option:checked + .apply-label i { color: #b480ff; }
.apply-option:checked + .apply-label span { color: #b480ff; }

/* Toggle */
.toggle-row { display: flex; align-items: center; justify-content: space-between; padding: 14px 16px; border-radius: 12px; background: #fdf9ff; border: 1.5px solid #ede9fe; }
.toggle-info h4 { font-size: 13px; font-weight: 600; color: #1a1a2e; margin-bottom: 2px; }
.toggle-info p  { font-size: 11px; color: #9ca3af; }
.toggle-switch { position: relative; width: 40px; height: 22px; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #d1d5db; border-radius: 22px; transition: 0.3s; }
.toggle-slider:before { position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: 0.3s; }
.toggle-switch input:checked + .toggle-slider { background: #b480ff; }
.toggle-switch input:checked + .toggle-slider:before { transform: translateX(18px); }

/* Submit */
.form-footer { display: flex; align-items: center; justify-content: flex-end; gap: 12px; }
.btn-submit { padding: 12px 32px; border-radius: 30px; background: linear-gradient(to right, #b480ff, #d3aa95); color: white; font-size: 14px; font-weight: 700; border: none; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; }
.btn-submit:hover { opacity: 0.88; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(180,128,255,0.3); }
.btn-cancel { font-size: 13px; color: #9ca3af; text-decoration: none; font-weight: 500; }

@media (max-width: 640px) { .f-row { grid-template-columns: 1fr; } .apply-grid { grid-template-columns: 1fr; } }
</style>

<div class="form-wrap">
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="form-inner">

    <div class="form-top">
        <h1>New Promo Code</h1>
        <a href="{{ route('admin.codes-promo.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.codes-promo.store') }}">
        @csrf

        {{-- CODE --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-tag"></i> Code & Discount</div>

            <div class="f-group">
                <label class="f-label">Promo Code *</label>
                <input type="text" name="code" id="codeInput" value="{{ old('code') }}" required autofocus
                       class="f-input f-mono" placeholder="e.g. SUMMER2026"
                       oninput="this.value = this.value.toUpperCase(); updatePreview(this.value)">
                <div class="code-preview" id="codePreview">{{ old('code') ?: 'MYCODE' }}</div>
                <p class="f-hint">Code is automatically converted to uppercase.</p>
                @error('code')<p class="f-error">{{ $message }}</p>@enderror
            </div>

            <div class="f-group">
                <label class="f-label">Description (optional)</label>
                <textarea name="description" class="f-input" rows="2" maxlength="500"
                          placeholder="Internal note about this promo...">{{ old('description') }}</textarea>
            </div>

            <div class="f-row" style="margin-bottom:0;">
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Discount Type *</label>
                    <select name="type_reduction" required class="f-input f-select">
                        <option value="pourcentage" {{ old('type_reduction','pourcentage') === 'pourcentage' ? 'selected' : '' }}>Percentage (%)</option>
                        <option value="montant" {{ old('type_reduction') === 'montant' ? 'selected' : '' }}>Fixed Amount (DA)</option>
                    </select>
                    @error('type_reduction')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Value *</label>
                    <input type="number" name="valeur" value="{{ old('valeur') }}" min="1" required class="f-input" placeholder="e.g. 20 for 20% or 500 DA">
                    <p class="f-hint">e.g. 20 for 20% or 500 for 500 DA</p>
                    @error('valeur')<p class="f-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- APPLIES TO --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-bullseye"></i> Applies To</div>
            <div class="apply-grid">
                <div>
                    <input type="radio" name="applicable_a" id="app_services" value="services"
                           class="apply-option" {{ old('applicable_a') === 'services' ? 'checked' : '' }}>
                    <label for="app_services" class="apply-label">
                        <i class="fa-solid fa-spa"></i>
                        <span>Services only</span>
                    </label>
                </div>
                <div>
                    <input type="radio" name="applicable_a" id="app_produits" value="produits"
                           class="apply-option" {{ old('applicable_a') === 'produits' ? 'checked' : '' }}>
                    <label for="app_produits" class="apply-label">
                        <i class="fa-solid fa-box"></i>
                        <span>Products only</span>
                    </label>
                </div>
                <div>
                    <input type="radio" name="applicable_a" id="app_both" value="les_deux"
                           class="apply-option" {{ old('applicable_a', 'les_deux') === 'les_deux' ? 'checked' : '' }}>
                    <label for="app_both" class="apply-label">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Both</span>
                    </label>
                </div>
            </div>
            @error('applicable_a')<p class="f-error" style="margin-top:8px;">{{ $message }}</p>@enderror
        </div>

        {{-- VALIDITY --}}
<div class="form-card">
    <div class="form-card-title"><i class="fa-regular fa-calendar"></i> Validity Period</div>

    <div class="f-row">
        <div class="f-group" style="margin-bottom:0;">
            <label class="f-label">Start Date *</label>
            <input type="datetime-local" name="date_debut" id="dateDebut" required class="f-input"
                   min="{{ now()->format('Y-m-d\TH:i') }}"
                   value="{{ old('date_debut', now()->format('Y-m-d\TH:i')) }}"
                   onchange="updateFinMin(this.value)">
            @error('date_debut')<p class="f-error">{{ $message }}</p>@enderror
        </div>
        <div class="f-group" style="margin-bottom:0;">
            <label class="f-label">End Date *</label>
            <input type="datetime-local" name="date_fin" id="dateFin" required class="f-input"
                   min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                   value="{{ old('date_fin', now()->addMonth()->format('Y-m-d\TH:i')) }}">
            @error('date_fin')<p class="f-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="f-group" style="margin-bottom:0;">
        <label class="f-label">Usage Limit (optional)</label>
        <input type="number" name="limite_utilisation" value="{{ old('limite_utilisation') }}"
               min="1" class="f-input" placeholder="Leave empty = unlimited">
        <p class="f-hint">Maximum number of times this code can be used.</p>
        @error('limite_utilisation')<p class="f-error">{{ $message }}</p>@enderror
    </div>
</div>

        {{-- STATUS --}}
        <div class="form-card">
            <div class="toggle-row">
                <div class="toggle-info">
                    <h4>Active Code</h4>
                    <p>Clients can use this code immediately</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.codes-promo.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Create Code
            </button>
        </div>

    </form>
</div>
</div>

<script>
function updatePreview(val) {
    document.getElementById('codePreview').textContent = val || 'MYCODE';
}
// Init
updatePreview(document.getElementById('codeInput').value);
</script>
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

function updateFinMin(val) {
    var fin = document.getElementById('dateFin');
    if (fin && val) {
        fin.min = val;
        if (fin.value && fin.value <= val) fin.value = '';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var dd = document.getElementById('dateDebut');
    if (dd) updateFinMin(dd.value);
});
</script>
</x-app-layout>
