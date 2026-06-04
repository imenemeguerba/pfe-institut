<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Le client n'a pas besoin d'un dashboard séparé.
     * La landing page sert de page d'accueil avec le navbar complet
     * (notifications, panier, favoris, RDV, etc.)
     */
    public function index(Request $request): RedirectResponse
    {
        return redirect()->route('landingpage');
    }
}
