<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Commande;
use App\Models\DemandeSuppression;
use App\Models\Produit;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard administrateur avec les stats clés.
     */
    public function index(): View
    {
        $stats = [
            'total_clients' => User::clients()->count(),
            'total_estheticiennes' => User::estheticiennes()->actifs()->count(),
            'esthe_en_attente' => User::estheticiennes()->enAttenteValidation()->count(),
            'rdv_aujourdhui' => RendezVous::whereDate('date_debut', today())->count(),
            'commandes_a_traiter' => Commande::enAttente()->count(),
            'avis_a_moderer' => Avis::enAttente()->count(),
            'demandes_suppression' => DemandeSuppression::enAttente()->count(),
            'produits_stock_critique' => Produit::stockCritique()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
