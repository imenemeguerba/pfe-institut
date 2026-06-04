<x-app-layout>
<x-slot name="header">My Profile</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- ✅ FIX SCROLL: prevent browser from restoring scroll --}}
<script>history.scrollRestoration = 'manual';</script>

<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
html, body { overflow-x: hidden; max-width: 100%; }
.p-wrap { margin:-24px; background:#f8f5ff; padding-bottom:48px; overflow-x:hidden; }

/* ── HERO ── */
.p-banner {
    position:relative; overflow:hidden;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    padding:56px 10% 100px;
}
.p-banner-circle { position:absolute; border-radius:50%; background:rgba(255,255,255,0.08); animation:pBannerFloat ease-in-out infinite alternate; }
.p-banner-c1 { width:300px; height:300px; top:-100px; right:-60px; animation-duration:5s; }
.p-banner-c2 { width:200px; height:200px; bottom:-80px; left:60px; animation-duration:7s; animation-delay:1s; }
.p-banner-c3 { width:120px; height:120px; top:20px; left:30%; animation-duration:4s; animation-delay:0.5s; background:rgba(255,255,255,0.05); }
@keyframes pBannerFloat { from{transform:scale(1) translate(0,0);} to{transform:scale(1.15) translate(10px,-10px);} }
.p-banner-content { position:relative; z-index:2; text-align:center; }
.p-banner-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 18px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:16px; }
.p-banner-title { font-family:'Playfair Display',serif; font-size:42px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.15); margin-bottom:8px; }
.p-banner-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.p-banner-sub { font-size:14px; color:rgba(255,255,255,0.88); }
.p-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23f8f5ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

.p-content { max-width:900px; margin:0 auto; padding:0 28px; }

/* IDENTITY CARD */
.p-identity { background:white; border-radius:20px; padding:24px 32px; margin-top:-55px; position:relative; z-index:10; border:1px solid rgba(180,128,255,0.12); box-shadow:0 8px 40px rgba(180,128,255,0.1); display:flex; align-items:center; gap:24px; margin-bottom:20px; }
.p-avatar-wrap { flex-shrink:0; }
.p-avatar { width:90px; height:90px; border-radius:50%; object-fit:cover; border:4px solid white; box-shadow:0 4px 16px rgba(180,128,255,0.25); }
.p-avatar-init { width:90px; height:90px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:30px; font-weight:800; display:flex; align-items:center; justify-content:center; border:4px solid white; box-shadow:0 4px 16px rgba(180,128,255,0.25); }
.p-identity-info { flex:1; }
.p-identity-info h2 { font-size:20px; font-weight:800; color:#1a1a2e; margin-bottom:3px; }
.p-identity-info p  { font-size:13px; color:#9ca3af; margin-bottom:8px; }
.p-badges { display:flex; gap:8px; }
.p-badge { font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; }
.p-badge.role   { background:rgba(180,128,255,0.12); color:#b480ff; }
.p-badge.status { background:rgba(16,185,129,0.1); color:#059669; }
.p-identity-stats { display:flex; gap:24px; flex-shrink:0; }
.p-stat { text-align:center; }
.p-stat strong { display:block; font-size:15px; font-weight:800; color:#1a1a2e; }
.p-stat span   { font-size:10px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; }
.p-stat-sep { width:1px; background:#ede9fe; align-self:stretch; }

/* SECTION CARDS */
.p-card { background:white; border-radius:16px; border:1px solid rgba(180,128,255,0.1); margin-bottom:16px; overflow:hidden; }
.p-card-header { display:flex; align-items:center; gap:12px; padding:18px 24px; border-bottom:1px solid #f7f5ff; }
.p-card-icon { width:34px; height:34px; border-radius:9px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:14px; }
.p-card-icon.red { background:rgba(239,68,68,0.1); color:#ef4444; }
.p-card-title { font-size:14px; font-weight:700; color:#1a1a2e; }
.p-card-body { padding:24px; }

/* PHOTO */
.photo-upload-area { display:flex; align-items:center; gap:20px; }
.photo-preview { width:72px; height:72px; border-radius:50%; object-fit:cover; border:3px solid rgba(180,128,255,0.2); flex-shrink:0; }
.photo-preview-init { width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,#b480ff,#d3aa95); color:white; font-size:24px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.photo-upload-right { flex:1; }
.photo-drop { border:2px dashed rgba(180,128,255,0.25); border-radius:12px; padding:16px 20px; background:#fdf9ff; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; gap:14px; margin-bottom:10px; }
.photo-drop:hover { border-color:#b480ff; background:rgba(180,128,255,0.04); }
.photo-drop-icon { width:38px; height:38px; border-radius:10px; background:rgba(180,128,255,0.1); color:#b480ff; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
.photo-drop-text h4 { font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:2px; }
.photo-drop-text p  { font-size:11px; color:#9ca3af; }
.photo-drop input[type="file"] { display:none; }
.photo-actions { display:flex; gap:10px; }

/* FORM FIELDS */
.fields-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:8px; }
.fields-grid.single { grid-template-columns:1fr; }
.f-label { display:block; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:6px; }
.f-input { width:100%; padding:11px 14px; border-radius:10px; border:1.5px solid #ede9fe; background:#fdf9ff; font-size:13px; color:#1a1a2e; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:all 0.2s; }
.f-input:focus { border-color:#b480ff; background:white; box-shadow:0 0 0 3px rgba(180,128,255,0.07); }
.f-error { font-size:11px; color:#ef4444; margin-top:4px; }
.btn-grad { padding:11px 24px; border-radius:30px; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; font-size:13px; font-weight:700; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-grad:hover { opacity:0.88; transform:translateY(-1px); box-shadow:0 6px 16px rgba(180,128,255,0.3); }
.btn-outline { padding:11px 24px; border-radius:30px; background:white; color:#b480ff; font-size:13px; font-weight:700; border:1.5px solid rgba(180,128,255,0.3); cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; }
.btn-outline:hover { border-color:#b480ff; background:rgba(180,128,255,0.05); }
.form-footer { display:flex; align-items:center; gap:14px; margin-top:20px; padding-top:18px; border-top:1px solid #f7f5ff; }

/* TOAST */
#profile-toast { position:fixed; bottom:30px; right:30px; color:white; padding:12px 22px; border-radius:30px; font-size:13px; font-weight:600; z-index:9999; box-shadow:0 8px 24px rgba(0,0,0,0.2); display:none; transition:opacity 0.3s; }

/* MODAL */
#confirm-overlay { display:none; position:fixed; inset:0; background:rgba(26,10,53,0.45); z-index:99999; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
#confirm-overlay.open { display:flex; }
#confirm-box { background:white; border-radius:20px; padding:32px 28px; max-width:380px; width:90%; text-align:center; box-shadow:0 20px 60px rgba(180,128,255,0.2); }
.c-icon { width:52px; height:52px; border-radius:50%; margin:0 auto 16px; display:flex; align-items:center; justify-content:center; font-size:22px; }
.c-icon.red { background:rgba(239,68,68,0.1); color:#ef4444; }
#confirm-box h3 { font-size:16px; font-weight:800; color:#1a1a2e; margin-bottom:8px; }
#confirm-box p  { font-size:13px; color:#6b7280; margin-bottom:24px; line-height:1.6; }
.c-actions { display:flex; gap:10px; justify-content:center; }
.c-cancel  { padding:10px 22px; border-radius:30px; border:1.5px solid #ede9fe; background:white; color:#6b7280; font-size:13px; font-weight:600; cursor:pointer; font-family:inherit; }
.c-cancel:hover { border-color:#b480ff; color:#b480ff; }
.c-confirm { padding:10px 22px; border-radius:30px; border:none; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; color:white; background:#ef4444; }
.c-confirm:hover { background:#dc2626; }

@media(max-width:768px) {
    .p-identity { flex-direction:column; }
    .fields-grid { grid-template-columns:1fr; }
    .p-identity-stats { display:none; }
    .photo-upload-area { flex-direction:column; }
}
</style>

<div class="p-wrap">

    {{-- ── HERO ── --}}
    <div class="p-banner">
        <div class="p-banner-circle p-banner-c1"></div>
        <div class="p-banner-circle p-banner-c2"></div>
        <div class="p-banner-circle p-banner-c3"></div>
        <div class="p-banner-content">
            <div class="p-banner-tag"><i class="fa-solid fa-user-circle"></i> My Account</div>
            <h1 class="p-banner-title">My <span>Profile</span></h1>
            <p class="p-banner-sub">Manage your personal information and preferences</p>
        </div>
        <div class="p-wave"></div>
    </div>

    <div class="p-content">

        {{-- IDENTITY --}}
        <div class="p-identity">
            <div class="p-avatar-wrap">
                @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}" class="p-avatar" alt="">
                @else
                    <div class="p-avatar-init">{{ strtoupper(substr($user->prenom,0,1)) }}</div>
                @endif
            </div>
            <div class="p-identity-info">
                <h2>{{ $user->fullName() }}</h2>
                <p>{{ $user->email }}</p>
                <div class="p-badges">
                    <span class="p-badge role">{{ $user->role === 'admin' ? 'Administrator' : ($user->role === 'estheticienne' ? 'Expert' : 'Client') }}</span>
                    <span class="p-badge status">{{ ucfirst($user->statut_compte) }}</span>
                </div>
            </div>
            <div class="p-identity-stats">
                <div class="p-stat">
                    <strong>{{ $user->created_at->format('M Y') }}</strong>
                    <span>Member since</span>
                </div>
                @if($user->telephone)
                    <div class="p-stat-sep"></div>
                    <div class="p-stat">
                        <strong>{{ $user->telephone }}</strong>
                        <span>Phone</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- PHOTO --}}
        <div class="p-card" id="photo">
            <div class="p-card-header">
                <div class="p-card-icon"><i class="fa-solid fa-camera"></i></div>
                <span class="p-card-title">Profile Photo</span>
            </div>
            <div class="p-card-body">
                <div class="photo-upload-area">
                    <div>
                        @if($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" class="photo-preview" id="photoPreview" alt="">
                        @else
                            <div class="photo-preview-init" id="photoPreviewInit">{{ strtoupper(substr($user->prenom,0,1)) }}</div>
                        @endif
                    </div>
                    <div class="photo-upload-right">
                        <form method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data"
                              onsubmit="saveScroll()">
                            @csrf @method('PATCH')
                            <label class="photo-drop" for="photoInput">
                                <div class="photo-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="photo-drop-text">
                                    <h4 id="photoLabel">Click to upload a new photo</h4>
                                    <p>JPG, PNG or WebP — max 2 MB</p>
                                </div>
                                <input type="file" id="photoInput" name="photo" accept="image/*"
                                    onchange="document.getElementById('photoLabel').textContent = this.files[0]?.name || 'Click to upload a new photo'; previewImg(this);">
                            </label>
                            @error('photo')<p class="f-error">{{ $message }}</p>@enderror
                            <div class="photo-actions">
                                <button type="submit" class="btn-grad">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Photo
                                </button>
                                @if($user->photo)
                                    <button type="button" class="btn-outline" onclick="confirmRemovePhoto()">
                                        <i class="fa-solid fa-trash"></i> Remove Photo
                                    </button>
                                @endif
                            </div>
                        </form>
                        <form id="deletePhotoForm" method="POST" action="{{ route('profile.photo.delete') }}" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- PERSONAL INFO --}}
        <div class="p-card" id="info">
            <div class="p-card-header">
                <div class="p-card-icon"><i class="fa-solid fa-user"></i></div>
                <span class="p-card-title">Personal Information</span>
            </div>
            <div class="p-card-body">
                <form method="post" action="{{ route('profile.update') }}" onsubmit="saveScroll()">
                    @csrf @method('patch')
                    <div class="fields-grid">
                        <div>
                            <label class="f-label">Last Name</label>
                            <input class="f-input" name="nom" type="text" value="{{ old('nom', $user->nom) }}" required>
                            @error('nom')<p class="f-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="f-label">First Name</label>
                            <input class="f-input" name="prenom" type="text" value="{{ old('prenom', $user->prenom) }}">
                        </div>
                    </div>
                    <div class="fields-grid">
                        <div>
                            <label class="f-label">Phone</label>
                            <input class="f-input" name="telephone" type="tel" value="{{ old('telephone', $user->telephone) }}">
                        </div>
                        @if($user->isClient())
                        <div>
                            <label class="f-label">Date of Birth</label>
                            <input class="f-input" name="date_naissance" id="dobInput" type="date"
                                value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}">
                            <p class="f-error" id="dobError" style="display:none;">You must be at least 18 years old.</p>
                        </div>
                        @endif
                    </div>
                    <div class="fields-grid single">
                        <div>
                            <label class="f-label">Email Address</label>
                            <input class="f-input" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<p class="f-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn-grad" id="saveInfoBtn">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="p-card" id="password">
            <div class="p-card-header">
                <div class="p-card-icon"><i class="fa-solid fa-lock"></i></div>
                <span class="p-card-title">Change Password</span>
            </div>
            <div class="p-card-body">
                <form method="post" action="{{ route('password.update') }}" onsubmit="saveScroll()">
                    @csrf @method('put')
                    <div class="fields-grid single">
                        <div>
                            <label class="f-label">Current Password</label>
                            <input class="f-input" name="current_password" type="password" autocomplete="current-password">
                            @if($errors->updatePassword->get('current_password'))
                                <p class="f-error">{{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="fields-grid">
                        <div>
                            <label class="f-label">New Password</label>
                            <input class="f-input" name="password" id="newPassword" type="password" autocomplete="new-password">
                            @if($errors->updatePassword->get('password'))
                                <p class="f-error">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>
                        <div>
                            <label class="f-label">Confirm New Password</label>
                            <input class="f-input" name="password_confirmation" id="confirmPassword" type="password" autocomplete="new-password">
                            <p class="f-error" id="confirmError" style="display:none;">Passwords do not match.</p>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn-grad" onclick="return validatePassword()">
                            <i class="fa-solid fa-lock"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DANGER ZONE --}}
        @if(Auth::user()->isClient() || Auth::user()->isEstheticienne())
        <div class="p-card" id="danger" style="border-color:rgba(239,68,68,0.15);">
            <div class="p-card-header">
                <div class="p-card-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <span class="p-card-title">Danger Zone</span>
            </div>
            <div class="p-card-body">
                @include('profile.partials.demande-suppression-form')
            </div>
        </div>
        @endif

    </div>
</div>

{{-- TOAST --}}
<div id="profile-toast"></div>

{{-- CONFIRM MODAL --}}
<div id="confirm-overlay">
    <div id="confirm-box">
        <div class="c-icon red"><i class="fa-solid fa-triangle-exclamation" id="c-icon-i"></i></div>
        <h3 id="c-title">Are you sure?</h3>
        <p id="c-msg">This action cannot be undone.</p>
        <div class="c-actions">
            <button class="c-cancel" onclick="closeModal()">Cancel</button>
            <button class="c-confirm" id="c-btn" onclick="doConfirm()">Confirm</button>
        </div>
    </div>
</div>

<script>
// ── SCROLL RESTORE ──────────────────────────────────────
// ✅ FIX: save before submit, restore after DOMContentLoaded with rAF
function saveScroll() {
    sessionStorage.setItem('profileScrollY', Math.round(window.scrollY));
}

window.addEventListener('load', function() {
    var y = sessionStorage.getItem('profileScrollY');
    if (y !== null) {
        sessionStorage.removeItem('profileScrollY');
        window.scrollTo({ top: parseInt(y), behavior: 'instant' });
    }
});

// ── TOAST ──────────────────────────────────────────────
function showToast(msg, type) {
    var t = document.getElementById('profile-toast');
    t.innerHTML = '<i class="fa-solid '+(type==='error'?'fa-circle-xmark':'fa-circle-check')+'" style="font-size:14px;margin-right:8px;flex-shrink:0;"></i>'+msg;
    t.style.background = type === 'error' ? '#ef4444' : '#1a1a2e';
    t.style.display = 'flex';
    t.style.alignItems = 'center';
    t.style.opacity = '1';
    clearTimeout(t._x);
    t._x = setTimeout(function() {
        t.style.opacity = '0';
        setTimeout(function() { t.style.display = 'none'; }, 300);
    }, 3500);
}

@if(session('status') === 'photo-updated')
    document.addEventListener('DOMContentLoaded', function(){ showToast('Profile photo updated successfully.', 'success'); });
@endif
@if(session('status') === 'photo-deleted')
    document.addEventListener('DOMContentLoaded', function(){ showToast('Profile photo removed successfully.', 'success'); });
@endif
@if(session('status') === 'profile-updated')
    document.addEventListener('DOMContentLoaded', function(){ showToast('Personal information saved successfully.', 'success'); });
@endif
@if(session('status') === 'password-updated')
    document.addEventListener('DOMContentLoaded', function(){ showToast('Password changed successfully.', 'success'); });
@endif
@if(session('success'))
    document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('success')), 'success'); });
@endif
@if(session('error'))
    document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('error')), 'error'); });
@endif

// ── CONFIRM MODAL ───────────────────────────────────────
var _cb = null;
function showConfirmModal(icon, title, msg, btnText, callback) {
    document.getElementById('c-icon-i').className = 'fa-solid ' + icon;
    document.getElementById('c-title').textContent = title;
    document.getElementById('c-msg').textContent   = msg;
    document.getElementById('c-btn').textContent   = btnText;
    _cb = callback;
    document.getElementById('confirm-overlay').classList.add('open');
}
function closeModal() { document.getElementById('confirm-overlay').classList.remove('open'); _cb = null; }
function doConfirm() { var fn = _cb; closeModal(); if (fn) fn(); }
document.getElementById('confirm-overlay').addEventListener('click', function(e) { if (e.target === this) closeModal(); });

// ── REMOVE PHOTO ────────────────────────────────────────
function confirmRemovePhoto() {
    showConfirmModal('fa-trash', 'Remove Profile Photo',
        'Are you sure you want to remove your profile photo?', 'Remove',
        function() { saveScroll(); document.getElementById('deletePhotoForm').submit(); }
    );
}

// ── PHOTO PREVIEW ───────────────────────────────────────
function previewImg(input) {
    if (!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var p = document.getElementById('photoPreview');
        var i = document.getElementById('photoPreviewInit');
        if (p) p.src = e.target.result;
        if (i) i.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

// ── DATE OF BIRTH +18 ───────────────────────────────────
var _saveInfoBtn = document.getElementById('saveInfoBtn');
if (_saveInfoBtn) {
    _saveInfoBtn.closest('form').addEventListener('submit', function(e) {
        var dob = document.getElementById('dobInput');
        if (!dob || !dob.value) return true;
        var d = new Date(dob.value), today = new Date();
        var age = today.getFullYear() - d.getFullYear();
        var m = today.getMonth() - d.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < d.getDate())) age--;
        if (age < 18) {
            e.preventDefault();
            document.getElementById('dobError').style.display = 'block';
            showToast('You must be at least 18 years old.', 'error');
            sessionStorage.removeItem('profileScrollY');
        } else {
            document.getElementById('dobError').style.display = 'none';
        }
    });
}

// ── PASSWORD VALIDATION ─────────────────────────────────
function validatePassword() {
    var p1  = document.getElementById('newPassword').value;
    var p2  = document.getElementById('confirmPassword').value;
    var err = document.getElementById('confirmError');
    if (p1 && p2 && p1 !== p2) {
        err.style.display = 'block';
        showToast('Passwords do not match.', 'error');
        sessionStorage.removeItem('profileScrollY');
        return false;
    }
    err.style.display = 'none';
    return true;
}

// ── DELETION REQUEST ────────────────────────────────────
function submitDeletionRequest() {
    var motif = document.getElementById('deletionMotif');
    var form  = document.getElementById('deletionRequestForm');
    if (motif) {
        var hidden = document.createElement('input');
        hidden.type  = 'hidden';
        hidden.name  = 'motif_demande';
        hidden.value = motif.value;
        form.appendChild(hidden);
    }
    saveScroll();
    form.submit();
}
function cancelDeletionRequest() {
    saveScroll();
    document.getElementById('cancelDeletionForm').submit();
}
</script>

</x-app-layout>
