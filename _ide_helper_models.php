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
 * @property int $estheticienne_id
 * @property string|null $titre
 * @property string|null $service
 * @property string $photo_avant
 * @property string $photo_apres
 * @property string|null $description
 * @property bool $public
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $estheticienne
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres wherePhotoApres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres wherePhotoAvant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvantApres whereUpdatedAt($value)
 */
	class AvantApres extends \Eloquent {}
}

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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\User|null $estheticienne
 * @property-read \App\Models\RendezVous|null $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis enAttente()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis publies()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis surEsthe()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis surInstitut()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereMotifRefus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis withoutTrashed()
 */
	class Avis extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property bool $actif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit> $produits
 * @property-read int|null $produits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategorieProduit whereUpdatedAt($value)
 */
	class CategorieProduit extends \Eloquent {}
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category actives()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\CodePromo|null $codePromo
 * @property-read \App\Models\Facture|null $facture
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produit> $produits
 * @property-read int|null $produits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande confirmees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande enAttente()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande pourClient($clientId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCodePromoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereDateAnnulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereDateConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereMotifAnnulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande wherePrixFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande wherePrixOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commande withoutTrashed()
 */
	class Commande extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $titre
 * @property string $contenu
 * @property string $type_peau
 * @property string $categorie
 * @property string|null $emoji
 * @property bool $actif
 * @property int $ordre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute pourTypePeau(string $typePeau)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereEmoji($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereOrdre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereTypePeau($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConseilBeaute whereUpdatedAt($value)
 */
	class ConseilBeaute extends \Eloquent {}
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
 * @property-read \App\Models\User|null $user
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
 * @property-read \App\Models\User|null $estheticienne
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\Commande|null $commande
 * @property-read \App\Models\RendezVous|null $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture deCommandes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture deRdv()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture pourClient($clientId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCheminPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCommandeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereDateEmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantTtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereMontantTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereTauxTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facture withoutTrashed()
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
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\Produit|null $produit
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
 * @property int $client_id
 * @property int $points
 * @property string $type
 * @property string $description
 * @property string|null $source_type
 * @property int|null $source_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $client
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $source
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FidelitePoint whereUpdatedAt($value)
 */
	class FidelitePoint extends \Eloquent {}
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
 * @property-read \App\Models\User|null $estheticienne
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
 * @property string $nom
 * @property string|null $description
 * @property string $email
 * @property string $telephone
 * @property string $adresse
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property string|null $ville
 * @property string|null $code_postal
 * @property string|null $logo
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $whatsapp
 * @property array<array-key, mixed>|null $horaires_ouverture
 * @property numeric $taux_tva
 * @property int $seuil_affluence_eleve
 * @property int $seuil_affluence_moyen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereHorairesOuverture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereSeuilAffluenceEleve($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereSeuilAffluenceMoyen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereTauxTva($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereVille($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Institut whereWhatsapp($value)
 */
	class Institut extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $sujet
 * @property string $message
 * @property string|null $reponse_admin
 * @property \Illuminate\Support\Carbon|null $repondu_at
 * @property bool $lu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereLu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereReponduAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereReponseAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereSujet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MessageContact whereUserId($value)
 */
	class MessageContact extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $client
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
 * @property int|null $categorie_id
 * @property string|null $description
 * @property string|null $image
 * @property int $prix
 * @property int $stock
 * @property int $seuil_alerte
 * @property bool $actif
 * @property string|null $types_peau
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property mixed $0
 * @property-read \App\Models\CategorieProduit|null $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $clientsFavoris
 * @property-read int|null $clients_favoris_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commande> $commandes
 * @property-read int|null $commandes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Panier> $paniers
 * @property-read int|null $paniers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProduitVariante> $variantes
 * @property-read int|null $variantes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit enStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit stockCritique()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereSeuilAlerte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereTypesPeau($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produit withoutTrashed()
 */
	class Produit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $produit_id
 * @property string $nom
 * @property int $prix
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Produit|null $produit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProduitVariante whereUpdatedAt($value)
 */
	class ProduitVariante extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegistrationOtp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegistrationOtp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegistrationOtp query()
 */
	class RegistrationOtp extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $groupe_reservation
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
 * @property string|null $motif_report
 * @property string|null $rappel_envoye_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\CodePromo|null $codePromo
 * @property-read \App\Models\User|null $estheticienne
 * @property-read \App\Models\Facture|null $facture
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous avenir()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous chevauchent($debut, $fin)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous confirmes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDureeTotale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereEstheticienneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereGroupeReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMotifRefus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMotifReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePrixFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePrixOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereRappelEnvoyeAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous withoutTrashed()
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
 * @property string|null $types_peau
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property mixed $0
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $estheticiennes
 * @property-read int|null $estheticiennes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceVariante> $variantes
 * @property-read int|null $variantes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service actifs()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service parCategorie($categoryId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service prixEntre($min, $max)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDuree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereTypesPeau($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service withoutTrashed()
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $service_id
 * @property string $nom
 * @property int $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service|null $service
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceVariante whereUpdatedAt($value)
 */
	class ServiceVariante extends \Eloquent {}
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
 * @property \Illuminate\Support\Carbon|null $email_libre_le
 * @property string|null $telephone
 * @property \Illuminate\Support\Carbon|null $date_naissance
 * @property int|null $experience
 * @property string|null $specialites
 * @property string|null $bio
 * @property string|null $type_peau
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FidelitePoint> $pointsFidelite
 * @property-read int|null $points_fidelite_count
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User nonSupprimes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User parRole(string $role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User supprimes()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDateNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailLibreLe($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSpecialites($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatutCompte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTypePeau($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

