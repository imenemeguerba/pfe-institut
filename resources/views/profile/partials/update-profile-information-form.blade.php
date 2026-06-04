<section>
<form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf @method('patch')

    <div class="form-row">
        <div class="form-group">
            <label for="nom">Last Name</label>
            <input id="nom" name="nom" type="text" value="{{ old('nom', $user->nom) }}" required autocomplete="family-name">
            @error('nom')<p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
            <label for="prenom">First Name</label>
            <input id="prenom" name="prenom" type="text" value="{{ old('prenom', $user->prenom) }}" autocomplete="given-name">
            @error('prenom')<p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="telephone">Phone</label>
            <input id="telephone" name="telephone" type="tel" value="{{ old('telephone', $user->telephone) }}" autocomplete="tel">
            @error('telephone')<p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
        </div>
        @if($user->isClient())
        <div class="form-group">
            <label for="date_naissance">Date of Birth</label>
            <input id="date_naissance" name="date_naissance" type="date" value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}">
            @error('date_naissance')<p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')<p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="btn-save">
        <i class="fa-solid fa-floppy-disk" style="margin-right:8px;"></i>Save Changes
    </button>
</form>
</section>
