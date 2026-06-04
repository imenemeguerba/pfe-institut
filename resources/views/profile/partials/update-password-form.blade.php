<section>
<form method="post" action="{{ route('password.update') }}">
    @csrf @method('put')

    <div class="form-group">
        <label for="update_password_current_password">Current Password</label>
        <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
        @if($errors->updatePassword->get('current_password'))
            <p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $errors->updatePassword->first('current_password') }}</p>
        @endif
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="update_password_password">New Password</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password">
            @if($errors->updatePassword->get('password'))
                <p style="font-size:11px;color:#ef4444;margin-top:4px;">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
        </div>
    </div>

    <button type="submit" class="btn-save">
        <i class="fa-solid fa-lock" style="margin-right:8px;"></i>Update Password
    </button>

    @if(session('status') === 'password-updated')
        <p style="font-size:13px;color:#10b981;margin-top:10px;">Password updated successfully!</p>
    @endif
</form>
</section>
