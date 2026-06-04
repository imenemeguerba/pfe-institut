<?php

namespace App\Services;

use App\Models\Facture;
use App\Models\Commande;
use App\Models\Institut;
use App\Models\RendezVous;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FactureService
{
    /**
     * Génère une facture pour un rendez-vous terminé.
     *
     * prix_final = montant HT (après promo éventuelle)
     * TVA lue depuis les settings de l'institut
     * TTC = HT + (HT × taux_tva / 100)
     */
    public static function genererPourRdv(RendezVous $rdv): Facture
    {
        if ($rdv->facture) return $rdv->facture;

        $institut = Institut::instance();
        $taux     = (float) ($institut->taux_tva ?? 19.00);

        // ✅ prix_final = HT (le prix stocké est hors TVA)
        $ht      = $rdv->prix_final;
        $tva     = (int) round($ht * $taux / 100);
        $ttc     = $ht + $tva;

        $numero  = self::genererNumero('FAC');

        $rdv->load(['client', 'estheticienne', 'services', 'codePromo']);

        $facture = Facture::create([
            'numero'          => $numero,
            'client_id'       => $rdv->client_id,
            'type'            => 'rendez_vous',
            'rendez_vous_id'  => $rdv->id,
            'commande_id'     => null,
            'montant_ht'      => $ht,
            'montant_tva'     => $tva,
            'montant_ttc'     => $ttc,
            'taux_tva'        => $taux,
            'date_emission'   => now(),
        ]);

        $pdf  = Pdf::loadView('pdf.facture', compact('facture', 'rdv', 'institut'));
        $path = 'factures/' . $numero . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());
        $facture->update(['chemin_pdf' => $path]);

        return $facture;
    }

    /**
     * Génère une facture pour une commande confirmée.
     *
     * prix_final = montant HT (après promo éventuelle)
     * TVA lue depuis les settings de l'institut
     * TTC = HT + (HT × taux_tva / 100)
     */
    public static function genererPourCommande(Commande $commande): Facture
    {
        if ($commande->facture) return $commande->facture;

        $institut = Institut::instance();
        $taux     = (float) ($institut->taux_tva ?? 19.00);

        // ✅ prix_final = HT (le prix stocké est hors TVA)
        $ht      = $commande->prix_final;
        $tva     = (int) round($ht * $taux / 100);
        $ttc     = $ht + $tva;

        $numero  = self::genererNumero('FAC');

        $commande->load(['client', 'produits', 'codePromo']);

        $facture = Facture::create([
            'numero'         => $numero,
            'client_id'      => $commande->client_id,
            'type'           => 'commande',
            'rendez_vous_id' => null,
            'commande_id'    => $commande->id,
            'montant_ht'     => $ht,
            'montant_tva'    => $tva,
            'montant_ttc'    => $ttc,
            'taux_tva'       => $taux,
            'date_emission'  => now(),
        ]);

        $pdf  = Pdf::loadView('pdf.facture', compact('facture', 'commande', 'institut'));
        $path = 'factures/' . $numero . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());
        $facture->update(['chemin_pdf' => $path]);

        return $facture;
    }

    /**
     * Génère un numéro unique de facture : FAC-2026-00001
     */
    public static function genererNumero(string $prefix = 'FAC'): string
    {
        $annee    = Carbon::now()->year;
        $derniere = Facture::whereYear('created_at', $annee)->count() + 1;
        return $prefix . '-' . $annee . '-' . str_pad($derniere, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Génère un numéro unique de commande : CMD-2026-00001
     */
    public static function genererNumeroCommande(): string
    {
        $annee    = Carbon::now()->year;
        $derniere = Commande::whereYear('created_at', $annee)->count() + 1;
        return 'CMD-' . $annee . '-' . str_pad($derniere, 5, '0', STR_PAD_LEFT);
    }
}