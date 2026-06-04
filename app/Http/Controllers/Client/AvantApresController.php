<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AvantApres;
use Illuminate\View\View;

class AvantApresController extends Controller
{
    public function index(): View
    {
        $photos = AvantApres::with('estheticienne')
            ->where('public', true)
            ->orderByDesc('created_at')
            ->get();

        return view('client.avant-apres.index', compact('photos'));
    }
}
