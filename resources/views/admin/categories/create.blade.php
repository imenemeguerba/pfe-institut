<x-app-layout>
<x-slot name="header">New Category</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.form-wrap { margin:-24px; padding:24px; background:#f8f5ff; }
.form-inner { max-width:620px; margin:0 auto; }
.form-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
.form-top h1 { font-size:18px; font-weight:800; color:#1a1a2e; }
.btn-back { font-size:12px; color:#b480ff; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:5px; padding:8px 14px; border-radius:30px; border:1.5px solid #ede9fe; background:white; }
.form-card { background:white; border-radius:16px; border:1px solid #ede9fe; padding:24px; margin-bottom:16px; }
.form-card-title { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.form-card-title i { color:#b480ff; }
.f-group { margin-bottom:18px; } .f-group:last-child { margin-bottom:0; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.f-input { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
textarea.f-input { resize:vertical; min-height:100px; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; }
.img-upload-area { display:flex; align-items:center; gap:16px; }
.img-preview-box { width:72px; height:72px; border-radius:14px; flex-shrink:0; background:#f5f0ff; border:2px dashed rgba(180,128,255,0.3); display:flex; align-items:center; justify-content:center; color:#c4b5fd; font-size:22px; overflow:hidden; }
.img-preview-box img { width:100%; height:100%; object-fit:cover; border-radius:12px; }
.img-drop { flex:1; border:2px dashed rgba(180,128,255,0.25); border-radius:12px; padding:14px 18px; background:#fdf9ff; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; gap:12px; }
.img-drop:hover { border-color:#b480ff; }
.img-drop-icon { width:34px; height:34px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }
.img-drop-text h4 { font-size:12px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.img-drop-text p  { font-size:11px; color:#9ca3af; }
.img-drop input { display:none; }
.toggle-row { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-radius:12px; background:#fdf9ff; border:1.5px solid #ede9fe; }
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
</style>

<div class="form-wrap">
    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

<div class="form-inner">
    <div class="form-top">
        <h1>New Service Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-card">
            <div class="form-card-title"><i class="fa-solid fa-folder"></i> Category Information</div>

            <div class="f-group">
                <label class="f-label">Category Name *</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required autofocus
                       class="f-input" placeholder="e.g. Facial, Massage, Makeup...">
                @error('nom')<p class="f-error">{{ $message }}</p>@enderror
            </div>
            <div class="f-group">
                <label class="f-label">Description</label>
                <textarea name="description" class="f-input" placeholder="Brief description of this category...">{{ old('description') }}</textarea>
                @error('description')<p class="f-error">{{ $message }}</p>@enderror
            </div>
            <div class="f-group">
                <label class="f-label">Image (optional)</label>
                <div class="img-upload-area">
                    <div class="img-preview-box" id="previewBox"><i class="fa-solid fa-folder"></i></div>
                    <label class="img-drop" for="imageInput">
                        <div class="img-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <div class="img-drop-text">
                            <h4 id="imgLabel">Click to upload an image</h4>
                            <p>JPG, PNG or WebP — Max 2 MB</p>
                        </div>
                        <input type="file" id="imageInput" name="image" accept="image/*" onchange="previewImg(this)">
                    </label>
                </div>
                @error('image')<p class="f-error" style="margin-top:8px;">{{ $message }}</p>@enderror
            </div>
            <div class="f-group" style="margin-bottom:0;">
                <div class="toggle-row">
                    <div class="toggle-info"><h4>Active Category</h4><p>Visible to clients when booking</p></div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Create Category</button>
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
