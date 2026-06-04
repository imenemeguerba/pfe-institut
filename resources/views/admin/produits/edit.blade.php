<x-app-layout>
<x-slot name="header">Edit Product</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.form-wrap  { margin:-24px; padding:24px; background:#f8f5ff; }
.form-inner { max-width:720px; margin:0 auto; }
.form-top   { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
.form-top h1 { font-size:18px; font-weight:800; color:#1a1a2e; }
.btn-back   { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }
.form-card  { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:16px; }
.form-card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.form-card-title i { color:#b480ff; }
.f-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
.f-row-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:16px; }
.f-group { margin-bottom:16px; } .f-group:last-child { margin-bottom:0; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.f-input { width:100%; padding:10px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
textarea.f-input { resize:vertical; min-height:90px; }
.f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:36px; cursor:pointer; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }
.f-hint  { font-size:11px; color:#c4b5fd; margin-top:4px; }
.f-link  { font-size:11px; color:#b480ff; text-decoration:none; font-weight:600; }
.img-upload-area { display:flex; align-items:center; gap:16px; }
.img-preview-box { width:80px; height:80px; border-radius:14px; flex-shrink:0; background:#f5f0ff; border:2px dashed rgba(180,128,255,0.3); display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:24px; overflow:hidden; }
.img-preview-box img { width:100%; height:100%; object-fit:cover; border-radius:12px; }
.img-drop { flex:1; border:2px dashed rgba(180,128,255,0.25); border-radius:12px; padding:14px 18px; background:#fdf9ff; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; gap:12px; }
.img-drop:hover { border-color:#b480ff; }
.img-drop-icon { width:36px; height:36px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
.img-drop-text h4 { font-size:12px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.img-drop-text p  { font-size:11px; color:#9ca3af; }
.img-drop input   { display:none; }
.skin-grid { display:flex; flex-wrap:wrap; gap:8px; }
.skin-item { display:flex; align-items:center; gap:6px; padding:7px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:#fdf9ff; cursor:pointer; font-size:12px; font-weight:500; color:#374151; transition:all 0.2s; }
.skin-item:hover { border-color:#b480ff; color:#b480ff; }
.skin-item input { width:14px; height:14px; accent-color:#b480ff; cursor:pointer; }
.toggle-row { display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-radius:12px; background:#fdf9ff; border:1.5px solid #ede9fe; }
.toggle-info h4 { font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.toggle-info p  { font-size:11px; color:#9ca3af; }
.toggle-switch { position:relative; width:40px; height:22px; }
.toggle-switch input { opacity:0; width:0; height:0; }
.toggle-slider { position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background:#d1d5db; border-radius:22px; transition:0.3s; }
.toggle-slider:before { position:absolute; content:""; height:16px; width:16px; left:3px; bottom:3px; background:white; border-radius:50%; transition:0.3s; }
.toggle-switch input:checked + .toggle-slider { background:#b480ff; }
.toggle-switch input:checked + .toggle-slider:before { transform:translateX(18px); }
.form-footer { display:flex; align-items:center; justify-content:flex-end; gap:12px; }
.btn-submit { padding:12px 32px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-submit:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 18px rgba(180,128,255,0.3); }
.btn-cancel { font-size:13px; color:#9ca3af; text-decoration:none; font-weight:500; }
.var-info-box { background:rgba(180,128,255,0.06); border:1px solid rgba(180,128,255,0.2); border-left:3px solid #b480ff; border-radius:10px; padding:10px 14px; margin-bottom:14px; font-size:12px; color:#6b7280; }
@media (max-width:640px) { .f-row-2,.f-row-3 { grid-template-columns:1fr; } }
</style>

<div class="form-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

<div class="form-inner">
    <div class="form-top">
        <h1>Edit Product — {{ $produit->nom }}</h1>
        <a href="{{ route('admin.produits.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.produits.update', $produit) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-box"></i> Product Information</div>
            <div class="f-row-2">
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Product Name *</label>
                    <input type="text" name="nom" value="{{ old('nom', $produit->nom) }}" required class="f-input">
                    @error('nom')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Category</label>
                    <select name="categorie_id" class="f-input f-select">
                        <option value="">— No category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('categorie_id', $produit->categorie_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                    <p class="f-hint">Manage categories <a href="{{ route('admin.categories-produits.index') }}" class="f-link">here →</a></p>
                </div>
            </div>
            <div class="f-group">
                <label class="f-label">Description</label>
                <textarea name="description" class="f-input">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div id="prixStockSection" style="{{ $produit->variantes->isNotEmpty() ? 'display:none;' : '' }}">
                <div class="f-row-3" style="margin-bottom:0;">
                    <div class="f-group" style="margin-bottom:0;">
                        <label class="f-label">Price (DA) *</label>
                        <input type="number" name="prix" id="prixInput" value="{{ old('prix', $produit->prix) }}" min="0" step="100" class="f-input">
                        @error('prix')<p class="f-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="f-group" style="margin-bottom:0;">
                        <label class="f-label">Stock *</label>
                        <input type="number" name="stock" id="stockInput" value="{{ old('stock', $produit->stock) }}" min="0" class="f-input">
                        @error('stock')<p class="f-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="f-group" style="margin-bottom:0;">
                        <label class="f-label">Alert Threshold *</label>
                        <input type="number" name="seuil_alerte" value="{{ old('seuil_alerte', $produit->seuil_alerte) }}" min="0" class="f-input">
                        <p class="f-hint">Alert when stock ≤</p>
                        @error('seuil_alerte')<p class="f-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div id="variantesActives" style="{{ $produit->variantes->isEmpty() ? 'display:none;' : '' }}">
                <div class="var-info-box">
                    <i class="fa-solid fa-circle-info" style="color:#b480ff;"></i>
                    Price and stock are managed per variant below.
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Alert Threshold *</label>
                    <input type="number" name="seuil_alerte" value="{{ old('seuil_alerte', $produit->seuil_alerte) }}" min="0" class="f-input" style="max-width:200px;">
                    <p class="f-hint">Alert when total stock ≤</p>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-image"></i> Product Image</div>
            <div class="img-upload-area">
                <div class="img-preview-box" id="previewBox">
                    @if($produit->image)
                        <img src="{{ asset('storage/'.$produit->image) }}" alt="">
                    @else
                        <i class="fa-solid fa-box"></i>
                    @endif
                </div>
                <label class="img-drop" for="imageInput">
                    <div class="img-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div class="img-drop-text">
                        <h4 id="imgLabel">{{ $produit->image ? 'Replace image' : 'Click to upload an image' }}</h4>
                        <p>JPG, PNG or WebP — Max 2 MB</p>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" onchange="previewImg(this)">
                </label>
            </div>
            @error('image')<p class="f-error" style="margin-top:8px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-leaf"></i> Recommended Skin Types</div>
            <p style="font-size:11px;color:#c4b5fd;margin-bottom:12px;">Leave empty = suitable for all skin types</p>
            <div class="skin-grid">
                @foreach(['normale'=>'🌿 Normal','grasse'=>'💧 Oily','seche'=>'🌵 Dry','mixte'=>'☯️ Combination','sensible'=>'🌸 Sensitive'] as $val => $label)
                    <label class="skin-item">
                        <input type="checkbox" name="types_peau[]" value="{{ $val }}"
                               {{ is_array($produit->types_peau) && in_array($val, $produit->types_peau) ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-layer-group"></i> Price Variants <span style="font-size:11px;font-weight:500;color:#9ca3af;margin-left:6px;">(optional)</span></div>
            <p style="font-size:11px;color:#c4b5fd;margin-bottom:12px;">Leave all empty to use the main price only.</p>
            <div style="display:grid;grid-template-columns:1fr 120px 100px 36px;gap:8px;margin-bottom:4px;">
                <span style="font-size:10px;font-weight:700;text-transform:uppercase;color:#c4b5fd;">Name (e.g. 50ml)</span>
                <span style="font-size:10px;font-weight:700;text-transform:uppercase;color:#c4b5fd;">Price (DA)</span>
                <span style="font-size:10px;font-weight:700;text-transform:uppercase;color:#c4b5fd;">Stock</span>
                <span></span>
            </div>
            <div id="varList">
                @forelse($produit->variantes as $i => $v)
                    <div class="var-row" style="display:grid;grid-template-columns:1fr 120px 100px 36px;gap:8px;margin-bottom:8px;">
                        <input type="hidden"  name="variantes[{{ $i }}][id]"    value="{{ $v->id }}">
                        <input type="text"    name="variantes[{{ $i }}][nom]"   value="{{ $v->nom }}" placeholder="e.g. 50ml" class="f-input">
                        <input type="number" name="variantes[{{ $i }}][prix]"  value="{{ $v->prix }}" min="0" step="100" class="f-input var-prix">
                        <input type="number" name="variantes[{{ $i }}][stock]" value="{{ $v->stock }}" min="0" class="f-input var-stock">
                        <button type="button" onclick="removeVar(this)" style="width:36px;height:36px;border-radius:50%;background:white;color:#ef4444;border:1.5px solid rgba(239,68,68,0.2);cursor:pointer;display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @empty
                    <div class="var-row" style="display:grid;grid-template-columns:1fr 120px 100px 36px;gap:8px;margin-bottom:8px;">
                        <input type="text"    name="variantes[0][nom]"   placeholder="e.g. 50ml" class="f-input">
                        <input type="number" name="variantes[0][prix]"  placeholder="0" min="0" step="100" class="f-input var-prix">
                        <input type="number" name="variantes[0][stock]" placeholder="0" min="0" class="f-input var-stock">
                        <button type="button" onclick="removeVar(this)" style="width:36px;height:36px;border-radius:50%;background:white;color:#ef4444;border:1.5px solid rgba(239,68,68,0.2);cursor:pointer;display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endforelse
            </div>
            <button type="button" onclick="addVar()" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:20px;background:rgba(180,128,255,0.08);color:#b480ff;border:1.5px dashed rgba(180,128,255,0.3);cursor:pointer;font-size:12px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;">
                <i class="fa-solid fa-plus"></i> Add Variant
            </button>
        </div>

        <div class="form-card">
            <div class="toggle-row">
                <div class="toggle-info"><h4>Active Product</h4><p>Visible to clients in the shop</p></div>
                <label class="toggle-switch">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $produit->actif) ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.produits.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
        </div>
    </form>
</div>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewBox').innerHTML = '<img src="' + e.target.result + '" alt="">';
            document.getElementById('imgLabel').textContent = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

var varIdx = {{ $produit->variantes->count() ?: 1 }};

function addVar() {
    var list = document.getElementById('varList');
    var row  = document.createElement('div');
    row.className = 'var-row';
    row.style.cssText = 'display:grid;grid-template-columns:1fr 120px 100px 36px;gap:8px;margin-bottom:8px;';
    row.innerHTML =
        '<input type="text"   name="variantes[' + varIdx + '][nom]"   placeholder="e.g. 100ml" class="f-input">' +
        '<input type="number" name="variantes[' + varIdx + '][prix]"  placeholder="0" min="0" step="100" class="f-input var-prix" oninput="updateStockPrix()">' +
        '<input type="number" name="variantes[' + varIdx + '][stock]" placeholder="0" min="0" class="f-input var-stock" oninput="updateStockPrix()">' +
        '<button type="button" onclick="removeVar(this)" style="width:36px;height:36px;border-radius:50%;background:white;color:#ef4444;border:1.5px solid rgba(239,68,68,0.2);cursor:pointer;display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-xmark"></i></button>';
    list.appendChild(row);
    varIdx++;
    updateStockPrix();
}

function removeVar(btn) {
    var rows = document.querySelectorAll('#varList .var-row');
    if (rows.length > 1) { btn.closest('.var-row').remove(); updateStockPrix(); }
}

function updateStockPrix() {
    var prixInputs  = document.querySelectorAll('.var-prix');
    var stockInputs = document.querySelectorAll('.var-stock');
    var hasVariante = false;
    prixInputs.forEach(function(i) { if (i.value && i.value > 0) hasVariante = true; });

    var section   = document.getElementById('prixStockSection');
    var message   = document.getElementById('variantesActives');
    var prixMain  = document.getElementById('prixInput');
    var stockMain = document.getElementById('stockInput');

    if (hasVariante) {
        section.style.display = 'none';
        message.style.display = 'block';
        var totalStock = 0;
        stockInputs.forEach(function(i) { totalStock += parseInt(i.value) || 0; });
        if (stockMain) stockMain.value = totalStock;
        var minPrix = Infinity;
        prixInputs.forEach(function(i) { if (i.value > 0) minPrix = Math.min(minPrix, parseInt(i.value)); });
        if (prixMain && minPrix !== Infinity) prixMain.value = minPrix;
    } else {
        section.style.display = '';
        message.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.var-prix, .var-stock').forEach(function(i) {
        i.addEventListener('input', updateStockPrix);
    });
    updateStockPrix();
});

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
