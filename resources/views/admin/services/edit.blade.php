<x-app-layout>
<x-slot name="header">Edit Service</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.form-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.form-inner { max-width:760px; margin:0 auto; }
.form-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
.form-top h1 { font-size:18px; font-weight:800; color:#1a1a2e; }
.btn-back { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }
.form-card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:22px 24px; margin-bottom:16px; }
.form-card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.form-card-title i { color:#b480ff; }
.f-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
.f-group { margin-bottom:16px; } .f-group:last-child { margin-bottom:0; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.f-input { width:100%; padding:10px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
textarea.f-input { resize:vertical; min-height:90px; }
.f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:36px; cursor:pointer; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }
.img-upload-area { display:flex; align-items:center; gap:16px; }
.img-preview-box { width:80px; height:80px; border-radius:14px; flex-shrink:0; background:#f5f0ff; border:2px dashed rgba(180,128,255,0.3); display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:24px; overflow:hidden; }
.img-preview-box img { width:100%; height:100%; object-fit:cover; border-radius:12px; }
.img-drop { flex:1; border:2px dashed rgba(180,128,255,0.25); border-radius:12px; padding:14px 18px; background:#fdf9ff; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; gap:12px; }
.img-drop:hover { border-color:#b480ff; }
.img-drop-icon { width:36px; height:36px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
.img-drop-text h4 { font-size:12px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.img-drop-text p  { font-size:11px; color:#9ca3af; }
.img-drop input { display:none; }
.check-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
.check-item { display:flex; align-items:center; gap:8px; padding:9px 12px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; cursor:pointer; transition:border-color 0.2s; }
.check-item:hover { border-color:#b480ff; }
.check-item input { width:15px; height:15px; accent-color:#b480ff; cursor:pointer; flex-shrink:0; }
.check-item-label { font-size:12px; font-weight:500; color:#374151; }
.check-item-sub   { font-size:10px; color:#9ca3af; }
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
.variante-row { display:flex; gap:10px; align-items:center; margin-bottom:8px; }
.btn-rm { width:28px; height:28px; border-radius:50%; background:#fff5f5; border:1px solid #fecaca; color:#ef4444; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:11px; flex-shrink:0; }
.btn-add { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:30px; background:#f5f0ff; color:#b480ff; font-size:12px; font-weight:600; border:1.5px solid #ede9fe; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; margin-top:4px; }
.btn-add:hover { border-color:#b480ff; }
.form-footer { display:flex; align-items:center; justify-content:flex-end; gap:12px; }
.btn-submit { padding:12px 32px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-submit:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 18px rgba(180,128,255,0.3); }
.btn-cancel { font-size:13px; color:#9ca3af; text-decoration:none; font-weight:500; }
@media (max-width:640px) { .f-row { grid-template-columns:1fr; } .check-grid { grid-template-columns:1fr; } }
</style>

<div class="form-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

<div class="form-inner">
    <div class="form-top">
        <h1>Edit Service — {{ $service->nom }}</h1>
        <a href="{{ route('admin.services.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data"
          x-data="{ variantes: {{ $service->variantes->toJson() }} }">
        @csrf @method('PUT')

        {{-- BASIC INFO --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-spa"></i> Service Information</div>
            <div class="f-row">
                <div class="f-group" style="margin-bottom:0;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                        <label class="f-label" style="margin-bottom:0;">Category *</label>
                        <a href="{{ route('admin.categories.create') }}" target="_blank"
                           style="font-size:11px;font-weight:700;color:#b480ff;text-decoration:none;display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;background:#f5f0ff;border:1px solid #ede9fe;transition:all 0.2s;"
                           onmouseover="this.style.background='#ede9fe'" onmouseout="this.style.background='#f5f0ff'">
                            <i class="fa-solid fa-plus" style="font-size:9px;"></i> New Category
                        </a>
                    </div>
                    <select name="category_id" required class="f-input f-select">
                        <option value="">— Choose a category —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Service Name *</label>
                    <input type="text" name="nom" value="{{ old('nom', $service->nom) }}" required class="f-input">
                    @error('nom')<p class="f-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="f-group">
                <label class="f-label">Description</label>
                <textarea name="description" class="f-input">{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="f-row" style="margin-bottom:0;">
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Base Price (DA) *</label>
                    <input type="number" name="prix" value="{{ old('prix', $service->prix) }}" min="0" step="100" required class="f-input">
                    @error('prix')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Duration (minutes) *</label>
                    <input type="number" name="duree" value="{{ old('duree', $service->duree) }}" min="5" max="480" step="5" required class="f-input">
                    @error('duree')<p class="f-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- IMAGE --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-image"></i> Service Image</div>
            <div class="img-upload-area">
                <div class="img-preview-box" id="previewBox">
                    @if($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" alt="">
                    @else
                        <i class="fa-solid fa-spa"></i>
                    @endif
                </div>
                <label class="img-drop" for="imageInput">
                    <div class="img-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div class="img-drop-text">
                        <h4 id="imgLabel">{{ $service->image ? 'Replace image' : 'Click to upload an image' }}</h4>
                        <p>JPG, PNG or WebP — Max 2 MB</p>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" onchange="previewImg(this)">
                </label>
            </div>
            @error('image')<p class="f-error" style="margin-top:8px;">{{ $message }}</p>@enderror
        </div>

        {{-- EXPERTS --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-user-nurse"></i> Assign Experts</div>
            @if($estheticiennes->isEmpty())
                <p style="font-size:13px;color:#d1d5db;">No active experts yet.</p>
            @else
                <div class="check-grid">
                    @foreach($estheticiennes as $esthe)
                        <label class="check-item">
                            <input type="checkbox" name="estheticiennes[]" value="{{ $esthe->id }}"
                                   {{ in_array($esthe->id, old('estheticiennes', $estheticiennesIds)) ? 'checked' : '' }}>
                            <div>
                                <div class="check-item-label">{{ $esthe->fullName() }}</div>
                                @if($esthe->specialites)<div class="check-item-sub">{{ Str::limit($esthe->specialites, 30) }}</div>@endif
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- SKIN TYPES --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-leaf"></i> Recommended Skin Types</div>
            <p style="font-size:11px;color:#c4b5fd;margin-bottom:12px;">Leave empty = suitable for all skin types</p>
            <div class="skin-grid">
                @foreach(['normale'=>'🌿 Normal','grasse'=>'💧 Oily','seche'=>'🌵 Dry','mixte'=>'☯️ Combination','sensible'=>'🌸 Sensitive'] as $val => $label)
                    <label class="skin-item">
                        <input type="checkbox" name="types_peau[]" value="{{ $val }}"
                               {{ in_array($val, $service->types_peau ?? []) ? 'checked' : '' }}> {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- VARIANTES --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-list-ul"></i> Price Variants (optional)</div>
            <p style="font-size:11px;color:#c4b5fd;margin-bottom:14px;">e.g. Short / Medium / Long</p>
            <template x-for="(v, index) in variantes" :key="index">
                <div class="variante-row">
                    <input type="text" :name="'variantes[' + index + '][nom]'" x-model="v.nom" placeholder="e.g. Short, Medium, Long" class="f-input" style="flex:1;margin:0;">
                    <input type="number" :name="'variantes[' + index + '][prix]'" x-model="v.prix" placeholder="Price DA" min="0" step="100" class="f-input" style="width:130px;margin:0;">
                    <button type="button" @click="variantes.splice(index, 1)" class="btn-rm"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </template>
            <button type="button" @click="variantes.push({nom:'',prix:''})" class="btn-add">
                <i class="fa-solid fa-plus"></i> Add variant
            </button>
        </div>

        {{-- STATUS --}}
        <div class="form-card">
            <div class="toggle-row">
                <div class="toggle-info"><h4>Active Service</h4><p>Visible to clients for booking</p></div>
                <label class="toggle-switch">
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $service->actif) ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.services.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
        </div>
    </form>
</div>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewBox').innerHTML = `<img src="${e.target.result}" alt="">`;
            document.getElementById('imgLabel').textContent = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function showToast(msg, type) {
    var t = document.getElementById('pg-toast');
    t.innerHTML = '<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';
    t.style.background = type==='error' ? '#ef4444' : '#1a1a2e';
    t.style.display='flex'; t.style.opacity='1';
    clearTimeout(t._x);
    t._x=setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); },4000);
}
@if(session('success'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('success')),'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('error')),'error'); });
@endif
</script>

</x-app-layout>
