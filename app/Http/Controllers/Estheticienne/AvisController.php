<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $avis = Avis::with('client')
            ->where('estheticienne_id', $userId)
            ->where('statut', 'publie')
            ->orderByDesc('created_at')
            ->paginate(10);

        $base = Avis::where('estheticienne_id', $userId)->where('statut', 'publie');

        $stats = [
            'total'        => (clone $base)->count(),
            'note_moyenne' => (clone $base)->avg('note') ?? 0,
            'note_5'       => (clone $base)->where('note', 5)->count(),
            'note_4'       => (clone $base)->where('note', 4)->count(),
            'note_3'       => (clone $base)->where('note', 3)->count(),
            'note_2'       => (clone $base)->where('note', 2)->count(),
            'note_1'       => (clone $base)->where('note', 1)->count(),
        ];

        return view('estheticienne.avis.index', compact('avis', 'stats'));
    }
}
