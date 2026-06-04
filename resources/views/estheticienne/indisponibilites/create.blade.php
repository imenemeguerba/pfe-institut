<x-app-layout>
<x-slot name="header">Report Absence</x-slot>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
.form-wrap{margin:-24px;padding:0;background:#f8f5ff;}
.cr-hero{position:relative;overflow:hidden;padding:36px 32px 78px;background:linear-gradient(135deg,#b480ff 0%,#c99ae8 50%,#d3aa95 100%);}
.cr-hero-dots{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.09) 1px,transparent 1px);background-size:28px 28px;}
.cr-hero-orb{position:absolute;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.09),transparent 70%);top:-70px;right:-50px;}
.cr-hero-content{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.cr-hero-tag{display:inline-flex;align-items:center;gap:7px;padding:5px 14px;border-radius:30px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.3);color:white;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:10px;}
.cr-hero-title{font-family:'Playfair Display',serif;font-size:28px;font-weight:800;color:white;line-height:1.2;}
.cr-hero-title span{-webkit-text-fill-color:rgba(255,255,255,0.75);}
.btn-back-hero{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:30px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);color:white;font-size:12px;font-weight:600;text-decoration:none;transition:all 0.2s;}
.btn-back-hero:hover{background:rgba(255,255,255,0.25);}
.cr-wave{position:absolute;bottom:-2px;left:0;right:0;height:55px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 55'%3E%3Cpath fill='%23f8f5ff' d='M0,28 C360,55 1080,0 1440,28 L1440,55 L0,55 Z'/%3E%3C/svg%3E") no-repeat bottom;background-size:cover;}
.form-body{padding:24px;}.form-inner{max-width:580px;margin:0 auto;}
.form-card{background:white;border-radius:16px;border:1px solid #ede9fe;padding:22px 24px;margin-bottom:16px;box-shadow:0 2px 10px rgba(180,128,255,0.05);opacity:0;animation:fadeUp 0.4s .05s forwards;}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.form-card-title{font-size:14px;font-weight:800;color:#1a1a2e;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
.form-card-title .ci{width:28px;height:28px;border-radius:8px;background:rgba(180,128,255,0.1);color:#b480ff;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;}
.tip-box{background:rgba(180,128,255,0.06);border:1px solid rgba(180,128,255,0.2);border-left:3px solid #b480ff;border-radius:10px;padding:12px 14px;margin-bottom:18px;font-size:12px;color:#6b7280;line-height:1.7;}
.f-group{margin-bottom:16px;}.f-group:last-child{margin-bottom:0;}
.f-label{display:block;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#9ca3af;margin-bottom:6px;}
.f-input{width:100%;padding:11px 14px;border-radius:10px;border:1.5px solid #ede9fe;background:#fdf9ff;font-size:13px;color:#1a1a2e;font-family:'Plus Jakarta Sans',sans-serif;outline:none;transition:border-color 0.2s;}
.f-input:focus{border-color:#b480ff;background:white;box-shadow:0 0 0 3px rgba(180,128,255,0.07);}
textarea.f-input{resize:vertical;min-height:80px;}
.f-error{font-size:11px;color:#ef4444;margin-top:5px;}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.f-hint{font-size:11px;color:#c4b5fd;margin-top:4px;}
.type-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;}
.type-opt{display:none;}
.type-label{display:flex;align-items:center;gap:10px;padding:12px 14px;border-radius:12px;border:1.5px solid #ede9fe;background:#fdf9ff;cursor:pointer;transition:all 0.2s;font-size:13px;font-weight:500;color:#374151;}
.type-label:hover{border-color:#b480ff;}
.type-label .type-emoji{font-size:18px;}
.type-opt:checked + .type-label{border-color:#b480ff;background:rgba(180,128,255,0.06);color:#b480ff;font-weight:600;}
.form-footer{display:flex;align-items:center;justify-content:flex-end;gap:12px;}
.btn-submit{padding:13px 32px;border-radius:30px;background:linear-gradient(to right,#b480ff,#d3aa95);color:white;font-size:14px;font-weight:700;border:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;display:inline-flex;align-items:center;gap:8px;transition:all 0.2s;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(180,128,255,0.35);}
.btn-cancel{font-size:13px;color:#9ca3af;text-decoration:none;font-weight:500;padding:8px 14px;border-radius:20px;border:1.5px solid #ede9fe;transition:all 0.2s;}
.btn-cancel:hover{border-color:#b480ff;color:#b480ff;}
</style>
<div class="form-wrap">
<div id="pg-toast" style="position:fixed;bottom:28px;right:28px;color:white;padding:12px 22px;border-radius:30px;font-size:13px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,0.2);display:none;align-items:center;gap:8px;max-width:380px;transition:opacity 0.3s;"></div>
<div class="cr-hero">
    <div class="cr-hero-dots"></div><div class="cr-hero-orb"></div>
    <div class="cr-hero-content">
        <div>
            <div class="cr-hero-tag"><i class="fa-solid fa-ban"></i> Absence</div>
            <div class="cr-hero-title">Report <span>Absence</span></div>
        </div>
        <a href="{{ route('estheticienne.planning.index') }}" class="btn-back-hero">
            <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Back to Planning
        </a>
    </div>
    <div class="cr-wave"></div>
</div>
<div class="form-body"><div class="form-inner">
    <form method="POST" action="{{ route('estheticienne.indisponibilites.store') }}">
        @csrf
        <div class="form-card">
            <div class="form-card-title"><div class="ci"><i class="fa-solid fa-ban"></i></div> Absence Details</div>
            <div class="tip-box">💡 Select the days you will be unavailable. You can choose a single day or a full period.</div>
            <div class="f-group">
                <label class="f-label">Absence Type *</label>
                <div class="type-grid">
                    @foreach(['conge'=>['🏖️','Vacation'],'maladie'=>['🤒','Sick Leave'],'formation'=>['🎓','Training'],'autre'=>['📌','Other']] as $val=>$info)
                        <div>
                            <input type="radio" name="type" id="type_{{ $val }}" value="{{ $val }}"
                                   class="type-opt" {{ old('type','conge')===$val?'checked':'' }}>
                            <label for="type_{{ $val }}" class="type-label">
                                <span class="type-emoji">{{ $info[0] }}</span>{{ $info[1] }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('type')<p class="f-error">{{ $message }}</p>@enderror
            </div>
            <div class="f-row">
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">From *</label>
                    <input type="date" name="date_debut_jour" required class="f-input"
                           min="{{ now()->format('Y-m-d') }}"
                           value="{{ old('date_debut_jour', now()->format('Y-m-d')) }}">
                    @error('date_debut_jour')<p class="f-error">{{ $message }}</p>@enderror
                </div>
                <div class="f-group" style="margin-bottom:0;">
                    <label class="f-label">To *</label>
                    <input type="date" name="date_fin_jour" required class="f-input"
                           min="{{ now()->format('Y-m-d') }}"
                           value="{{ old('date_fin_jour', now()->format('Y-m-d')) }}">
                    <p class="f-hint">Same date = single day absence</p>
                    @error('date_fin_jour')<p class="f-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="f-group" style="margin-top:16px;margin-bottom:0;">
                <label class="f-label">Reason (optional)</label>
                <textarea name="motif" class="f-input" rows="3" maxlength="500"
                          placeholder="e.g. Annual vacation, training in Algiers...">{{ old('motif') }}</textarea>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('estheticienne.planning.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Save Absence</button>
        </div>
    </form>
</div></div>
</div>
<script>
function showToast(msg,type){var t=document.getElementById('pg-toast');t.innerHTML='<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;flex-shrink:0;"></i><span>'+msg+'</span>';t.style.background=type==='error'?'#ef4444':'#1a1a2e';t.style.display='flex';t.style.opacity='1';clearTimeout(t._x);t._x=setTimeout(function(){t.style.opacity='0';setTimeout(function(){t.style.display='none';},300);},4000);}
@if(session('success'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('success')),'success');});@endif
@if(session('error'))document.addEventListener('DOMContentLoaded',function(){showToast(@json(session('error')),'error');});@endif
</script>
</x-app-layout>
