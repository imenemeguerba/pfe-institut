<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property string $type
 * @property int|null $estheticienne_id
 * @property int|null $rendez_vous_id
 * @property int $note
 * @property string $commentaire
 * @property string $statut
 * @property string|null $motif_refus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \App\Models\User|null $estheticienne
 * @property-read \App\Models\RendezVous|null $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis enAttente()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis publies()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis surEsthe()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis surInstitut()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereMotifRefus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereUpdatedAt($value)
 */
	class Avis extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property string|null $image
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category actives()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property string $type_reduction
 * @property int $valeur
 * @property string $applicable_a
 * @property \Illuminate\Support\Carbon $date_debut
 * @property \Illuminate\Support\Carbon $date_fin
 * @property int|null $limite_utilisation
 * @property int $nombre_utilisations
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commande> $commandes
 * @property-read int|null $commandes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo valides()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereApplicableA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereLimiteUtilisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereNombreUtilisations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereTypeReduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodePromo whereValeur($value)
 */
	class CodePromo extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $numero
 * @property int $client_id
 * @property string $statut
 * @property int $prix_original
 * @property int $prix_final
 * @property int|null $code_promo_id
 * @property \Illuminate\Support\Carbon|null $date_confirmation
 * @property \Illuminate\Support\Carbon|null $date_annulation
 * @property string|null $motif_annulation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \App\Models\CodePromo|null $codePromo
 * @property-read \App\Models\Facture|null $facture
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit> $produits
 * @property-read int|null $produits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande confirmees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande enAttente()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande pourClient($clientId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCodePromoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereDateAnnulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereDateConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereMotifAnnulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande wherePrixFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande wherePrixOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereUpdatedAt($value)
 */
	class Commande extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $statut
 * @property string|null $motif_demande
 * @property string|null $motif_refus
 * @property \Illuminate\Support\Carbon|null $date_traitement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression acceptees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression enAttente()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression refusees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereDateTraitement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereMotifDemande($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereMotifRefus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DemandeSuppression whereUserId($value)
 */
	class DemandeSuppression extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $estheticienne_id
 * @property int $jour_semaine
 * @property string $heure_debut
 * @property string $heure_fin
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $estheticienne
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite actives()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite pourJour(int $jour)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereHeureDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereHeureFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereJourSemaine($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disponibilite whereUpdatedAt($value)
 */
	class Disponibilite extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $numero
 * @property int $client_id
 * @property string $type
 * @property int|null $rendez_vous_id
 * @property int|null $commande_id
 * @property int $montant_ht
 * @property int $montant_tva
 * @property int $montant_ttc
 * @property numeric $taux_tva
 * @property \Illuminate\Support\Carbon $date_emission
 * @property string|null $chemin_pdf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \App\Models\Commande|null $commande
 * @property-read \App\Models\RendezVous|null $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture deCommandes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture deRdv()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture pourClient($clientId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCheminPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCommandeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereDateEmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantTtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereTauxTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereUpdatedAt($value)
 */
	class Facture extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property int $produit_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \App\Models\Produit $produit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Favori whereUpdatedAt($value)
 */
	class Favori extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $estheticienne_id
 * @property \Illuminate\Support\Carbon $date_debut
 * @property \Illuminate\Support\Carbon $date_fin
 * @property string $type
 * @property string|null $motif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $estheticienne
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite avenir()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite chevauchent($debut, $fin)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereMotif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Indisponibilite whereUpdatedAt($value)
 */
	class Indisponibilite extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit> $produits
 * @property-read int|null $produits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Panier whereUpdatedAt($value)
 */
	class Panier extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property string|null $image
 * @property int $prix
 * @property int $stock
 * @property int $seuil_alerte
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $clientsFavoris
 * @property-read int|null $clients_favoris_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commande> $commandes
 * @property-read int|null $commandes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Panier> $paniers
 * @property-read int|null $paniers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit enStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit stockCritique()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereSeuilAlerte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereUpdatedAt($value)
 */
	class Produit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property int $estheticienne_id
 * @property \Illuminate\Support\Carbon $date_debut
 * @property \Illuminate\Support\Carbon $date_fin
 * @property int $duree_totale
 * @property int $prix_original
 * @property int $prix_final
 * @property int|null $code_promo_id
 * @property string $statut
 * @property string|null $notes
 * @property string|null $motif_refus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $client
 * @property-read \App\Models\CodePromo|null $codePromo
 * @property-read \App\Models\User $estheticienne
 * @property-read \App\Models\Facture|null $facture
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous avenir()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous chevauchent($debut, $fin)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous confirmes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous passes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous pourClient($clientId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous pourEsthe($estheId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous statut(string $statut)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereCodePromoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDureeTotale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMotifRefus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePrixFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePrixOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereUpdatedAt($value)
 */
	class RendezVous extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property string $nom
 * @property string|null $description
 * @property string|null $image
 * @property int $prix
 * @property int $duree
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $estheticiennes
 * @property-read int|null $estheticiennes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service parCategorie($categoryId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service prixEntre($min, $max)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDuree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereUpdatedAt($value)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string|null $prenom
 * @property string $email
 * @property string $role
 * @property string $statut_compte
 * @property string|null $motif_statut
 * @property string|null $telephone
 * @property \Illuminate\Support\Carbon|null $date_naissance
 * @property int|null $experience
 * @property string|null $bio
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Avis> $avis
 * @property-read int|null $avis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Avis> $avisRecus
 * @property-read int|null $avis_recus_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commande> $commandes
 * @property-read int|null $commandes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DemandeSuppression> $demandesSuppression
 * @property-read int|null $demandes_suppression_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Disponibilite> $disponibilites
 * @property-read int|null $disponibilites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facture> $factures
 * @property-read int|null $factures_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Indisponibilite> $indisponibilites
 * @property-read int|null $indisponibilites_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Panier|null $panier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit> $produitsFavoris
 * @property-read int|null $produits_favoris_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVousAssignes
 * @property-read int|null $rendez_vous_assignes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $servicesProposes
 * @property-read int|null $services_proposes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User admins()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User bloques()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User clients()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User enAttenteValidation()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User estheticiennes()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User parRole(string $role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDateNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMotifStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatutCompte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

