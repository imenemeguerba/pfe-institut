<x-app-layout>
<x-slot name="header">Add Before & After</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.form-wrap { margin:-24px; padding:0; background:#f8f5ff; }

/* ── HERO (compact) ── */
.cr-hero {
    position:relative; overflow:hidden;
    padding:36px 32px 80px;
    background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);
}
.cr-hero-dots { position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,0.09) 1px,transparent 1px); background-size:28px 28px; }
.cr-hero-orb { position:absolute; width:260px; height:260px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.09),transparent 70%); top:-70px; right:-50px; }
.cr-hero-content { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.cr-hero-tag { display:inline-flex; align-items:center; gap:7px; padding:5px 14px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.3); color:white; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:10px; }
.cr-hero-title { font-family:'Playfair Display',serif; font-size:28px; font-weight:800; color:white; text-shadow:0 2px 12px rgba(0,0,0,0.12); line-height:1.2; }
.cr-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); }
.btn-back-hero { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:30px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); color:white; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s; }
.btn-back-hero:hover { background:rgba(255,255,255,0.25); }
.cr-wave { position:absolute; bottom:-2px; left:0; right:0; height:55px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 55'%3E%3Cpath fill='%23f8f5ff' d='M0,28 C360,55 1080,0 1440,28 L1440,55 L0,55 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.form-body { padding:24px; }
.form-inner { max-width:640px; margin:0 auto; }

/* CARD */
.form-card {
    background:white; border-radius:16px; border:1px solid #ede9fe;
    padding:22px 24px; margin-bottom:16px;
    box-shadow:0 2px 10px rgba(180,128,255,0.05);
    opacity:0; animation:fadeUp 0.4s forwards;
}
.form-card:nth-child(1){animation-delay:.05s}
.form-card:nth-child(2){animation-delay:.1s}
.form-card:nth-child(3){animation-delay:.15s}
.form-card:nth-child(4){animation-delay:.2s}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.form-card-title { font-size:14px; font-weight:800; color:#1a1a2e; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.form-card-title .ci { width:28px; height:28px; border-radius:8px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:12px; flex-shrink:0; }

/* FIELDS */
.f-group { margin-bottom:16px; }
.f-group:last-child { margin-bottom:0; }
.f-label { display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:#9ca3af; margin-bottom:6px; }
.f-input { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
textarea.f-input { resize:vertical; min-height:80px; }
.f-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c4b5fd' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:36px; cursor:pointer; }
.f-error { font-size:11px; color:#ef4444; margin-top:5px; display:flex; align-items:center; gap:4px; }
.f-error i { font-size:10px; }
.f-cat { font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; background:rgba(180,128,255,0.08); color:#b480ff; display:inline-block; margin-top:6px; }

/* PHOTO UPLOAD */
.photos-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.photo-box {
    border:2px dashed rgba(180,128,255,0.25); border-radius:14px;
    padding:18px 14px; background:#fdf9ff; cursor:pointer;
    transition:all 0.2s; position:relative; display:block; text-align:center;
}
.photo-box:hover { border-color:#b480ff; background:#f8f0ff; }
.photo-box.avant { border-color:rgba(107,114,128,0.3); }
.photo-box.avant:hover { border-color:#6b7280; background:#f9fafb; }
.photo-box-icon { font-size:32px; margin-bottom:8px; display:block; }
.photo-box-title { font-size:12px; font-weight:800; color:#1a1a2e; margin-bottom:3px; }
.photo-box-sub { font-size:10px; color:#9ca3af; }
.photo-box input { display:none; }
.photo-preview-img { width:100%; height:130px; object-fit:cover; border-radius:10px; margin-bottom:8px; }
.photo-filename { font-size:10px; color:#b480ff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; padding:0 4px; }

/* TOGGLE */
.toggle-row { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-radius:12px; background:#fdf9ff; border:1.5px solid #ede9fe; }
.toggle-info h4 { font-size:13px; font-weight:700; color:#1a1a2e; margin-bottom:2px; }
.toggle-info p  { font-size:11px; color:#9ca3af; }
.toggle-switch { position:relative; width:40px; height:22px; flex-shrink:0; }
.toggle-switch input { opacity:0; width:0; height:0; }
.toggle-slider { position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background:#d1d5db; border-radius:22px; transition:.3s; }
.toggle-slider:before { position:absolute; content:""; height:16px; width:16px; left:3px; bottom:3px; background:white; border-radius:50%; transition:.3s; }
.toggle-switch input:checked + .toggle-slider { background:#b480ff; }
.toggle-switch input:checked + .toggle-slider:before { transform:translateX(18px); }

/* FOOTER */
.form-footer { display:flex; align-items:center; justify-content:flex-end; gap:12px; }
.btn-submit { padding:13px 32px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:14px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-submit:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(180,128,255,0.35); }
.btn-cancel { font-size:13px; color:#9ca3af; text-decoration:none; font-weight:500; padding:8px 14px; border-radius:20px; border:1.5px solid #ede9fe; transition:all 0.2s; }
.btn-cancel:hover { border-color:#b480ff; color:#b480ff; }
</style>

<div class="form-wrap">

    {{-- TOAST --}}
    <div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>

    {{-- HERO --}}
    <div class="cr-hero">
        <div class="cr-hero-dots"></div>
        <div class="cr-hero-orb"></div>
        <div class="cr-hero-content">
            <div>
                <div class="cr-hero-tag"><i class="fa-solid fa-images"></i> New Gallery</div>
                <div class="cr-hero-title">Add <span>Before &amp; After</span></div>
            </div>
            <a href="{{ route('estheticienne.avant-apres.index') }}" class="btn-back-hero">
                <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Back to Gallery
            </a>
        </div>
        <div class="cr-wave"></div>
    </div>

    <div class="form-body">
    <div class="form-inner">

        <form method="POST" action="{{ route('estheticienne.avant-apres.store') }}"
              enctype="multipart/form-data"
              x-data="{
                  services: {{ $services->map(fn($s) => ['nom' => $s->nom, 'categorie' => $s->category?->nom ?? ''])->toJson() }},
                  selectedService: '{{ old('service') }}',
                  get categorie() {
                      const s = this.services.find(s => s.nom === this.selectedService);
                      return s ? s.categorie : '';
                  }
              }">
            @csrf

            {{-- SERVICE --}}
            <div class="form-card">
                <div class="form-card-title">
                    <div class="ci"><i class="fa-solid fa-spa"></i></div>
                    Service
                </div>
                <div class="f-group">
                    <label class="f-label">Service *</label>
                    <select name="service" required class="f-input f-select" x-model="selectedService">
                        <option value="">— Choose a service —</option>
                        @foreach($services as $svc)
                            <option value="{{ $svc->nom }}">{{ $svc->nom }}</option>
                        @endforeach
                    </select>
                    @error('service')
                        <p class="f-error"><i class="fa-solid fa-circle-xmark"></i> {{ $message }}</p>
                    @enderror
                    <div x-show="categorie">
                        <span class="f-cat" x-text="categorie"></span>
                    </div>
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">Description (optional)</label>
                    <textarea name="description" class="f-input" rows="3" maxlength="500"
                              placeholder="Describe the transformation...">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- PHOTOS --}}
            <div class="form-card">
                <div class="form-card-title">
                    <div class="ci"><i class="fa-solid fa-images"></i></div>
                    Photos
                </div>
                <div class="photos-grid">

                    {{-- BEFORE --}}
                    <label class="photo-box avant" for="photoAvant">
                        <div id="prevAvant">
                            <span class="photo-box-icon">🖤</span>
                            <div class="photo-box-title">BEFORE Photo *</div>
                            <div class="photo-box-sub">Click to upload — Max 3 MB</div>
                        </div>
                        <input type="file" id="photoAvant" name="photo_avant" accept="image/*" required
                               onchange="previewPhoto(this,'prevAvant','nameAvant')">
                        <div class="photo-filename" id="nameAvant"></div>
                    </label>

                    {{-- AFTER --}}
                    <label class="photo-box" for="photoApres">
                        <div id="prevApres">
                            <span class="photo-box-icon">💜</span>
                            <div class="photo-box-title">AFTER Photo *</div>
                            <div class="photo-box-sub">Click to upload — Max 3 MB</div>
                        </div>
                        <input type="file" id="photoApres" name="photo_apres" accept="image/*" required
                               onchange="previewPhoto(this,'prevApres','nameApres')">
                        <div class="photo-filename" id="nameApres"></div>
                    </label>

                </div>
                @error('photo_avant')
                    <p class="f-error" style="margin-top:8px;"><i class="fa-solid fa-circle-xmark"></i> {{ $message }}</p>
                @enderror
                @error('photo_apres')
                    <p class="f-error"><i class="fa-solid fa-circle-xmark"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- VISIBILITY --}}
            <div class="form-card">
                <div class="toggle-row">
                    <div class="toggle-info">
                        <h4>Visible to Clients</h4>
                        <p>Show this work in your public gallery</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="public" value="1" {{ old('public', true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('estheticienne.avant-apres.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-images"></i> Publish Photos
                </button>
            </div>
        </form>

    </div>
    </div>
</div>

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
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('success')),'success'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded',function(){ showToast(@json(session('error')),'error'); });
@endif

function previewPhoto(input, previewId, nameId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const box = document.getElementById(previewId);
            box.innerHTML = `<img src="${e.target.result}" class="photo-preview-img" alt="">`;
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById(nameId).textContent = input.files[0].name;
    }
}
</script>

</x-app-layout>
