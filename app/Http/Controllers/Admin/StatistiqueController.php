<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Institut;
use App\Models\Produit;
use App\Models\RendezVous;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StatistiqueController extends Controller
{
    public function index(Request $request): View
    {
        $periode = $request->query('periode', 'annee'); // annee | mois | semaine

        // ── Calcul de la plage de dates selon la période ─────────────────
        [$debut, $fin, $labelPeriode] = $this->getPeriode($periode, $request);

        // ── KPIs de la période ────────────────────────────────────────────
        $stats = [
            'total_clients'          => User::where('role', 'client')->count(),
            'total_esthes'           => User::where('role', 'estheticienne')->where('statut_compte', 'actif')->count(),
            'rdv_termines'           => RendezVous::where('statut', 'termine')->whereBetween('date_debut', [$debut, $fin])->count(),
            'rdv_total'              => RendezVous::where('statut', 'termine')->count(),
            'rdv_ce_mois'            => RendezVous::where('statut', 'termine')->whereMonth('date_debut', now()->month)->whereYear('date_debut', now()->year)->count(),
            'commandes_confirmees'   => Commande::where('statut', 'confirmee')->whereBetween('created_at', [$debut, $fin])->count(),
            'revenus_rdv'            => Facture::where('type', 'rendez_vous')->whereBetween('date_emission', [$debut, $fin])->sum('montant_ttc'),
            'revenus_produits'       => Facture::where('type', 'commande')->whereBetween('date_emission', [$debut, $fin])->sum('montant_ttc'),
            'note_moyenne_inst'      => Avis::where('type', 'institut')->where('statut', 'publie')->avg('note') ?? 0,
            'produits_stock_critique'=> Produit::whereColumn('stock', '<=', 'seuil_alerte')->count(),
            'avis_en_attente'        => Avis::where('statut', 'en_attente')->count(),
        ];
        $stats['revenus_total'] = $stats['revenus_rdv'] + $stats['revenus_produits'];

        // ── Données graphique selon période ───────────────────────────────
        $chartData = $this->getChartData($periode, $request);

        // ── Top 5 services ────────────────────────────────────────────────
        $topServices = DB::table('rendez_vous_service')
            ->join('services', 'services.id', '=', 'rendez_vous_service.service_id')
            ->join('rendez_vous', 'rendez_vous.id', '=', 'rendez_vous_service.rendez_vous_id')
            ->where('rendez_vous.statut', 'termine')
            ->whereBetween('rendez_vous.date_debut', [$debut, $fin])
            ->selectRaw('services.nom, COUNT(*) as nb')
            ->groupBy('services.id', 'services.nom')
            ->orderByDesc('nb')
            ->limit(5)
            ->get();

        // ── Top 5 esthéticiennes ──────────────────────────────────────────
        $topEsthes = User::where('role', 'estheticienne')
            ->withCount(['rendezVousAssignes as nb_rdv' => fn($q) =>
                $q->where('statut', 'termine')->whereBetween('date_debut', [$debut, $fin])
            ])
            ->orderByDesc('nb_rdv')
            ->limit(5)
            ->get();

        // ── Top 5 produits vendus ─────────────────────────────────────────
        $topProduits = DB::table('commande_produit')
            ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
            ->join('commandes', 'commandes.id', '=', 'commande_produit.commande_id')
            ->where('commandes.statut', 'confirmee')
            ->whereBetween('commandes.created_at', [$debut, $fin])
            ->selectRaw('produits.nom, SUM(commande_produit.quantite) as total_vendu')
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('total_vendu')
            ->limit(5)
            ->get();

        $clientsRecents = User::where('role', 'client')->orderByDesc('created_at')->take(5)->get();

        return view('admin.statistiques.index', compact(
            'stats', 'chartData', 'topServices', 'topEsthes', 'topProduits',
            'clientsRecents', 'periode', 'labelPeriode'
        ));
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    private function getPeriode(string $periode, Request $request): array
    {
        return match ($periode) {
            'semaine' => [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
                'Cette semaine (' . now()->startOfWeek()->format('d/m') . ' — ' . now()->endOfWeek()->format('d/m/Y') . ')',
            ],
            'mois' => [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
                now()->isoFormat('MMMM YYYY'),
            ],
            default => [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
                'Année ' . now()->year,
            ],
        };
    }

    private function getChartData(string $periode, Request $request): array
    {
        $labels = [];
        $rdvData = [];
        $revenusData = [];
        $commandesData = [];

        if ($periode === 'semaine') {
            // Jours de la semaine
            $jours = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
            $start = Carbon::now()->startOfWeek();
            for ($i = 0; $i < 7; $i++) {
                $date = $start->copy()->addDays($i);
                $labels[]     = $jours[$i];
                $rdvData[]    = RendezVous::where('statut', 'termine')->whereDate('date_debut', $date)->count();
                $revenusData[]= (int) Facture::whereDate('date_emission', $date)->sum('montant_ttc');
                $commandesData[] = Commande::where('statut', 'confirmee')->whereDate('created_at', $date)->count();
            }
        } elseif ($periode === 'mois') {
            // Semaines du mois
            $start = Carbon::now()->startOfMonth();
            $end   = Carbon::now()->endOfMonth();
            $week  = $start->copy()->startOfWeek();
            $nb = 0;
            while ($week->lte($end) && $nb < 5) {
                $wStart = $week->copy();
                $wEnd   = $week->copy()->endOfWeek();
                $labels[]        = 'Sem ' . ($nb + 1);
                $rdvData[]       = RendezVous::where('statut', 'termine')->whereBetween('date_debut', [$wStart, $wEnd])->count();
                $revenusData[]   = (int) Facture::whereBetween('date_emission', [$wStart, $wEnd])->sum('montant_ttc');
                $commandesData[] = Commande::where('statut', 'confirmee')->whereBetween('created_at', [$wStart, $wEnd])->count();
                $week->addWeek();
                $nb++;
            }
        } else {
            // 12 mois de l'année
            $moisNoms = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
            for ($m = 1; $m <= 12; $m++) {
                $labels[]        = $moisNoms[$m - 1];
                $rdvData[]       = RendezVous::where('statut', 'termine')->whereMonth('date_debut', $m)->whereYear('date_debut', now()->year)->count();
                $revenusData[]   = (int) Facture::whereMonth('date_emission', $m)->whereYear('date_emission', now()->year)->sum('montant_ttc');
                $commandesData[] = Commande::where('statut', 'confirmee')->whereMonth('created_at', $m)->whereYear('created_at', now()->year)->count();
            }
        }

        return compact('labels', 'rdvData', 'revenusData', 'commandesData');
    }

    // ── Export PDF ────────────────────────────────────────────────────────
     public function exportPDF()
{
    $institut    = Institut::instance();
    $dateRapport = now()->format('d/m/Y at H:i');

    $stats = [
        'total_clients'           => User::where('role', 'client')->count(),
        'total_esthes'            => User::where('role', 'estheticienne')->where('statut_compte', 'actif')->count(),
        'rdv_termines'            => RendezVous::where('statut', 'termine')->count(),
        'rdv_ce_mois'             => RendezVous::where('statut', 'termine')->whereMonth('date_debut', now()->month)->whereYear('date_debut', now()->year)->count(),
        'commandes_confirmees'    => Commande::where('statut', 'confirmee')->count(),
        'revenus_rdv'             => Facture::where('type', 'rendez_vous')->sum('montant_ttc'),
        'revenus_produits'        => Facture::where('type', 'commande')->sum('montant_ttc'),
        'produits_stock_critique' => Produit::whereColumn('stock', '<=', 'seuil_alerte')->count(),
    ];
    $stats['revenus_total'] = $stats['revenus_rdv'] + $stats['revenus_produits'];

    $activiteMois = collect();
    for ($i = 11; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $activiteMois->push([
            'mois'      => $date->isoFormat('MMMM YYYY'),
            'rdv'       => RendezVous::where('statut', 'termine')->whereMonth('date_debut', $date->month)->whereYear('date_debut', $date->year)->count(),
            'revenus'   => (int) Facture::whereMonth('date_emission', $date->month)->whereYear('date_emission', $date->year)->sum('montant_ttc'),
            'commandes' => Commande::where('statut', 'confirmee')->whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count(),
        ]);
    }

    $topServices = DB::table('rendez_vous_service')
        ->join('services', 'services.id', '=', 'rendez_vous_service.service_id')
        ->join('rendez_vous', 'rendez_vous.id', '=', 'rendez_vous_service.rendez_vous_id')
        ->where('rendez_vous.statut', 'termine')
        ->selectRaw('services.nom, COUNT(*) as nb')
        ->groupBy('services.id', 'services.nom')
        ->orderByDesc('nb')->limit(5)->get();

    $topEsthes = User::where('role', 'estheticienne')
        ->withCount(['rendezVousAssignes as nb_rdv' => fn($q) => $q->where('statut', 'termine')])
        ->orderByDesc('nb_rdv')->limit(5)->get();

    $topProduits = DB::table('commande_produit')
        ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
        ->join('commandes', 'commandes.id', '=', 'commande_produit.commande_id')
        ->where('commandes.statut', 'confirmee')
        ->selectRaw('produits.nom, SUM(commande_produit.quantite) as total_vendu')
        ->groupBy('produits.id', 'produits.nom')
        ->orderByDesc('total_vendu')->limit(5)->get();

    // ✅ Retourne la vue directement — le navigateur gère l'impression/PDF
    // Chart.js ne fonctionne pas avec DomPDF, le bouton "Print" de la page suffit
    return view('admin.rapport', compact(
        'stats', 'activiteMois', 'topServices', 'topEsthes', 'topProduits', 'institut', 'dateRapport'
    ));
}

    // ── Envoyer promo ─────────────────────────────────────────────────────

    public function envoyerPromo(Request $request)
    {
        $request->validate(['message_promo' => ['required', 'string', 'min:10', 'max:500']]);

        $clients = User::where('role', 'client')->where('statut_compte', 'actif')->get();
        foreach ($clients as $client) {
            try {
                $client->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'promotion',
                    'data'    => json_encode(['message' => '🎁 ' . $request->message_promo]),
                    'read_at' => null,
                ]);
            } catch (\Exception $e) { continue; }
        }

        return back()->with('success', "Notification envoyee a {$clients->count()} client(s) !");
    }
}
