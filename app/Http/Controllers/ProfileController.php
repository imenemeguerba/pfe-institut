<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('scrollTo', 'info');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);

        $user = $request->user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->update([
            'photo' => $request->file('photo')->store('photos-profil', 'public'),
        ]);

        return redirect()->route('profile.edit')
            ->with('status', 'photo-updated')
            ->with('scrollTo', 'photo');
    }

    public function deletePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            $user->update(['photo' => null]);
        }

        return redirect()->route('profile.edit')
            ->with('status', 'photo-deleted')
            ->with('scrollTo', 'photo');
    }

    public function demanderSuppression(Request $request): RedirectResponse
    {
        $request->validate([
            'motif_demande' => ['nullable', 'string', 'max:500'],
        ]);

        $user = $request->user();

        if ($user->demandeSuppressionEnCours()) {
            return redirect()->route('profile.edit')
                ->with('error', 'You already have a pending deletion request.')
                ->with('scrollTo', 'danger');
        }

        $rdvFuturs = $user->rendezVous()
            ->where('date_debut', '>=', now())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->count();

        if ($rdvFuturs > 0) {
            return redirect()->route('profile.edit')
                ->with('error', 'Cannot delete: you have ' . $rdvFuturs . ' upcoming appointment(s).')
                ->with('scrollTo', 'danger');
        }

        \App\Models\DemandeSuppression::create([
            'user_id'       => $user->id,
            'motif_demande' => $request->motif_demande,
            'statut'        => 'en_attente',
        ]);

        return redirect()->route('profile.edit')
            ->with('success', 'Your deletion request has been submitted.')
            ->with('scrollTo', 'danger');
    }

    public function annulerDemandeSuppression(\App\Models\DemandeSuppression $demande): RedirectResponse
    {
        if ($demande->user_id !== Auth::id()) {
            abort(403);
        }

        $demande->delete();

        return redirect()->route('profile.edit')
            ->with('success', 'Your deletion request has been cancelled.')
            ->with('scrollTo', 'danger');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
