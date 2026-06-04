<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\AvantApres;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AvantApresController extends Controller
{
    public function index(Request $request): View
    {
        $photos = AvantApres::where('estheticienne_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('estheticienne.avant-apres.index', compact('photos'));
    }

    public function create(Request $request): View
{
    $services = $request->user()->servicesProposes()
                ->where('actif', true)
                ->orderBy('nom')
                ->get();

    return view('estheticienne.avant-apres.create', compact('services'));
}

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titre'       => ['nullable', 'string', 'max:150'],
            'service'     => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'photo_avant' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'photo_apres' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'public'      => ['nullable', 'boolean'],
        ]);

        AvantApres::create([
            'estheticienne_id' => $request->user()->id,
            'titre'            => $request->titre,
            'service'          => $request->service,
            'description'      => $request->description,
            'photo_avant'      => $request->file('photo_avant')->store('avant-apres', 'public'),
            'photo_apres'      => $request->file('photo_apres')->store('avant-apres', 'public'),
            'public'           => $request->has('public'),
        ]);

        return redirect()->route('estheticienne.avant-apres.index')
            ->with('success', 'Before & after photos added successfully!');
    }

    public function destroy(Request $request, AvantApres $avantApres): RedirectResponse
    {
        if ($avantApres->estheticienne_id !== $request->user()->id) {
            abort(403);
        }

        Storage::disk('public')->delete($avantApres->photo_avant);
        Storage::disk('public')->delete($avantApres->photo_apres);
        $avantApres->delete();

        return back()->with('success', 'Photos deleted successfully.');
    }
}
