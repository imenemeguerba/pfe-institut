<?php
// ════════════════════════════════════════════════════════
// app/Http/Controllers/Admin/VarianteController.php
// Gère la sauvegarde des variantes pour services et produits
// ════════════════════════════════════════════════════════

namespace App\Http\Controllers\Admin;

use App\Models\ProduitVariante;
use App\Models\ServiceVariante;

class VarianteController
{
    /**
     * Sauvegarde les variantes d'un service
     * Appeler depuis ServiceController::store() et update()
     */
    public static function syncService($service, array $variantes): void
    {
        // Supprimer les anciennes
        $service->variantes()->delete();

        // Créer les nouvelles
        foreach ($variantes as $v) {
            if (!empty($v['nom']) && isset($v['prix'])) {
                ServiceVariante::create([
                    'service_id' => $service->id,
                    'nom'        => $v['nom'],
                    'prix'       => (int) $v['prix'],
                ]);
            }
        }
    }

    /**
     * Sauvegarde les variantes d'un produit
     * Appeler depuis ProduitController::store() et update()
     */
    public static function syncProduit($produit, array $variantes): void
    {
        $produit->variantes()->delete();

        foreach ($variantes as $v) {
            if (!empty($v['nom']) && isset($v['prix'])) {
                ProduitVariante::create([
                    'produit_id' => $produit->id,
                    'nom'        => $v['nom'],
                    'prix'       => (int) $v['prix'],
                    'stock'      => (int) ($v['stock'] ?? 0),
                ]);
            }
        }
    }
}
