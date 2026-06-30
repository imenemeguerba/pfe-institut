<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('landingpage');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'estheticienne') return redirect()->route('estheticienne.dashboard');
    return redirect()->route('landingpage');
})->middleware(['auth', 'verified'])->name('dashboard');


    // OTP Reset Password
Route::get('/forgot-password/otp', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'showEmailForm'])
    ->name('password.otp.email')->middleware('guest');
Route::post('/forgot-password/otp/send', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'sendOtp'])
    ->name('password.otp.send')->middleware('guest');
Route::get('/forgot-password/otp/verify', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'showVerifyForm'])
    ->name('password.otp.verify')->middleware('guest');
Route::post('/forgot-password/otp/verify', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'verifyOtp'])
    ->name('password.otp.verify.post')->middleware('guest');
Route::get('/forgot-password/otp/reset', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'showResetForm'])
    ->name('password.otp.reset')->middleware('guest');
Route::post('/forgot-password/otp/reset', [\App\Http\Controllers\Auth\OtpPasswordResetController::class, 'resetPassword'])
    ->name('password.otp.update')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/demande-suppression', [ProfileController::class, 'demanderSuppression'])->name('profile.demande-suppression');
    Route::post('/notifications/marquer-lues', [\App\Http\Controllers\NotificationController::class, 'marquerLues'])->name('notifications.marquer-lues');
    Route::post('/notifications/{id}/marquer-lue', [\App\Http\Controllers\NotificationController::class, 'marquerLue'])->name('notifications.marquer-lue');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

Route::get('/register-estheticienne', [\App\Http\Controllers\Auth\RegisteredEstheticienneController::class, 'create'])
    ->middleware('guest')
    ->name('register.estheticienne');
Route::post('/register-estheticienne', [\App\Http\Controllers\Auth\RegisteredEstheticienneController::class, 'store'])
    ->middleware('guest');

Route::delete('/demande-suppression/{demande}/annuler', [ProfileController::class, 'annulerDemandeSuppression'])
    ->name('demande-suppression.annuler');

// ========================================================================
// ADMIN
// ========================================================================
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::patch('/categories/{category}/toggle', [\App\Http\Controllers\Admin\CategoryController::class, 'toggle'])
            ->name('categories.toggle');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        Route::patch('/services/{service}/toggle', [\App\Http\Controllers\Admin\ServiceController::class, 'toggle'])
            ->name('services.toggle');
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

        Route::patch('/produits/{produit}/toggle', [\App\Http\Controllers\Admin\ProduitController::class, 'toggle'])
            ->name('produits.toggle');
        Route::resource('produits', \App\Http\Controllers\Admin\ProduitController::class);

        Route::patch('/codes-promo/{codePromo}/toggle', [\App\Http\Controllers\Admin\CodePromoController::class, 'toggle'])
            ->name('codes-promo.toggle');
        Route::resource('codes-promo', \App\Http\Controllers\Admin\CodePromoController::class)
            ->parameters(['codes-promo' => 'codePromo']);

        Route::get('/institut', [\App\Http\Controllers\Admin\InstitutController::class, 'edit'])
            ->name('institut.edit');
        Route::patch('/institut', [\App\Http\Controllers\Admin\InstitutController::class, 'update'])
            ->name('institut.update');

        Route::get('/estheticiennes', [\App\Http\Controllers\Admin\EstheticienneController::class, 'index'])
            ->name('estheticiennes.index');
        Route::get('/estheticiennes/{estheticienne}', [\App\Http\Controllers\Admin\EstheticienneController::class, 'show'])
            ->name('estheticiennes.show');
        Route::patch('/estheticiennes/{estheticienne}/accepter', [\App\Http\Controllers\Admin\EstheticienneController::class, 'accepter'])
            ->name('estheticiennes.accepter');
        Route::delete('/estheticiennes/{estheticienne}/refuser', [\App\Http\Controllers\Admin\EstheticienneController::class, 'refuser'])
            ->name('estheticiennes.refuser');
        Route::patch('/estheticiennes/{estheticienne}/desactiver', [\App\Http\Controllers\Admin\EstheticienneController::class, 'desactiver'])
            ->name('estheticiennes.desactiver');
        Route::patch('/estheticiennes/{estheticienne}/reactiver', [\App\Http\Controllers\Admin\EstheticienneController::class, 'reactiver'])
            ->name('estheticiennes.reactiver');
        Route::delete('/estheticiennes/{estheticienne}', [\App\Http\Controllers\Admin\EstheticienneController::class, 'destroy'])
            ->name('estheticiennes.destroy');
        Route::patch('/estheticiennes/{estheticienne}/services', [\App\Http\Controllers\Admin\EstheticienneController::class, 'updateServices'])
            ->name('estheticiennes.services');

        Route::get('/clients', [\App\Http\Controllers\Admin\ClientController::class, 'index'])
            ->name('clients.index');
        Route::get('/clients/{client}', [\App\Http\Controllers\Admin\ClientController::class, 'show'])
            ->name('clients.show');
        Route::patch('/clients/{client}/bloquer', [\App\Http\Controllers\Admin\ClientController::class, 'bloquer'])
            ->name('clients.bloquer');
        Route::patch('/clients/{client}/debloquer', [\App\Http\Controllers\Admin\ClientController::class, 'debloquer'])
            ->name('clients.debloquer');
        Route::delete('/clients/{client}', [\App\Http\Controllers\Admin\ClientController::class, 'destroy'])
            ->name('clients.destroy');

        Route::get('/demandes-suppression', [\App\Http\Controllers\Admin\DemandeSuppressionController::class, 'index'])
            ->name('demandes-suppression.index');
        Route::get('/demandes-suppression/{demande}', [\App\Http\Controllers\Admin\DemandeSuppressionController::class, 'show'])
            ->name('demandes-suppression.show');
        Route::patch('/demandes-suppression/{demande}/accepter', [\App\Http\Controllers\Admin\DemandeSuppressionController::class, 'accepter'])
            ->name('demandes-suppression.accepter');
        Route::patch('/demandes-suppression/{demande}/refuser', [\App\Http\Controllers\Admin\DemandeSuppressionController::class, 'refuser'])
            ->name('demandes-suppression.refuser');
        Route::get('/commandes', [\App\Http\Controllers\Admin\CommandeController::class, 'index'])
            ->name('commandes.index');
        Route::get('/commandes/{commande}', [\App\Http\Controllers\Admin\CommandeController::class, 'show'])
            ->name('commandes.show');
        Route::patch('/commandes/{commande}/confirmer', [\App\Http\Controllers\Admin\CommandeController::class, 'confirmer'])
            ->name('commandes.confirmer');
        Route::patch('/commandes/{commande}/annuler', [\App\Http\Controllers\Admin\CommandeController::class, 'annuler'])
            ->name('commandes.annuler');

        Route::get('/factures', [\App\Http\Controllers\Admin\FactureController::class, 'index'])
            ->name('factures.index');
        Route::get('/factures/{facture}', [\App\Http\Controllers\Admin\FactureController::class, 'show'])
            ->name('factures.show');
        Route::get('/factures/{facture}/telecharger', [\App\Http\Controllers\Admin\FactureController::class, 'telecharger'])
            ->name('factures.telecharger');

        // Rendez-vous admin
        Route::get('/rendez-vous', [\App\Http\Controllers\Admin\RendezVousController::class, 'index'])
            ->name('rendez-vous.index');
        Route::get('/rendez-vous/calendrier', [\App\Http\Controllers\Admin\RendezVousController::class, 'calendrier'])
            ->name('rendez-vous.calendrier');
        Route::get('/rendez-vous/{rendezVous}', [\App\Http\Controllers\Admin\RendezVousController::class, 'show'])
            ->name('rendez-vous.show');
        Route::get('/avis', [\App\Http\Controllers\Admin\AvisController::class, 'index'])
            ->name('avis.index');
        Route::patch('/avis/{avi}/approuver', [\App\Http\Controllers\Admin\AvisController::class, 'approuver'])
            ->name('avis.approuver');
        Route::patch('/avis/{avi}/refuser', [\App\Http\Controllers\Admin\AvisController::class, 'refuser'])
            ->name('avis.refuser');

        Route::get('/categories-produits', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'index'])
            ->name('categories-produits.index');
        Route::get('/categories-produits/create', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'create'])
            ->name('categories-produits.create');
        Route::post('/categories-produits', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'store'])
            ->name('categories-produits.store');
        Route::get('/categories-produits/{categorieProduit}/edit', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'edit'])
            ->name('categories-produits.edit');
        Route::patch('/categories-produits/{categorieProduit}', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'update'])
            ->name('categories-produits.update');
        Route::patch('/categories-produits/{categorieProduit}/toggle', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'toggle'])
            ->name('categories-produits.toggle');
        Route::delete('/categories-produits/{categorieProduit}', [\App\Http\Controllers\Admin\CategorieProduitController::class, 'destroy'])
            ->name('categories-produits.destroy');
        Route::get('/statistiques', [\App\Http\Controllers\Admin\StatistiqueController::class, 'index'])
            ->name('statistiques.index');
        Route::get('/statistiques/export-pdf', [\App\Http\Controllers\Admin\StatistiqueController::class, 'exportPDF'])
            ->name('statistiques.export-pdf');
        Route::post('/statistiques/envoyer-promo', [\App\Http\Controllers\Admin\StatistiqueController::class, 'envoyerPromo'])
            ->name('statistiques.envoyer-promo');
        Route::get('/messages-contact', [\App\Http\Controllers\Admin\MessageContactController::class, 'index'])
            ->name('messages-contact.index');
        Route::get('/messages-contact/{messagesContact}', [\App\Http\Controllers\Admin\MessageContactController::class, 'show'])
            ->name('messages-contact.show');
        Route::patch('/messages-contact/{messagesContact}/repondre', [\App\Http\Controllers\Admin\MessageContactController::class, 'repondre'])
            ->name('messages-contact.repondre');
        Route::delete('/messages-contact/{messagesContact}', [\App\Http\Controllers\Admin\MessageContactController::class, 'destroy'])
            ->name('messages-contact.destroy');
    });

// ========================================================================
// ESTHÉTICIENNE
// ========================================================================
Route::middleware(['auth', 'verified', 'estheticienne'])
    ->prefix('esthe')
    ->name('estheticienne.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Estheticienne\DashboardController::class, 'index'])
            ->name('dashboard');
        Route::get('/welcome', [\App\Http\Controllers\Estheticienne\DashboardController::class, 'welcome'])
            ->name('welcome');

        Route::get('/planning', [\App\Http\Controllers\Estheticienne\PlanningController::class, 'index'])
            ->name('planning.index');

        Route::resource('disponibilites', \App\Http\Controllers\Estheticienne\DisponibiliteController::class)
            ->except(['index', 'show']);

        Route::resource('indisponibilites', \App\Http\Controllers\Estheticienne\IndisponibiliteController::class)
            ->except(['index', 'show']);

        Route::get('/rendez-vous', [\App\Http\Controllers\Estheticienne\RendezVousController::class, 'index'])
            ->name('rendez-vous.index');
        Route::get('/rendez-vous/{rendezVous}', [\App\Http\Controllers\Estheticienne\RendezVousController::class, 'show'])
            ->name('rendez-vous.show');
        Route::patch('/rendez-vous/{rendezVous}/accepter', [\App\Http\Controllers\Estheticienne\RendezVousController::class, 'accepter'])
            ->name('rendez-vous.accepter');
        Route::patch('/rendez-vous/{rendezVous}/refuser', [\App\Http\Controllers\Estheticienne\RendezVousController::class, 'refuser'])
            ->name('rendez-vous.refuser');

        Route::patch('/rendez-vous/{rendezVous}/terminer', [\App\Http\Controllers\Estheticienne\RendezVousController::class, 'terminer'])
            ->name('rendez-vous.terminer');
        Route::get('/performance', [\App\Http\Controllers\Estheticienne\PerformanceController::class, 'index'])
           ->name('performance.index');
        Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])
          ->name('contact.index');
        Route::post('/contact', [\App\Http\Controllers\Client\ContactController::class, 'store'])
          ->name('contact.store');
        Route::get('/avant-apres', [\App\Http\Controllers\Estheticienne\AvantApresController::class, 'index'])
          ->name('avant-apres.index');
        Route::get('/avant-apres/create', [\App\Http\Controllers\Estheticienne\AvantApresController::class, 'create'])
          ->name('avant-apres.create');
        Route::post('/avant-apres', [\App\Http\Controllers\Estheticienne\AvantApresController::class, 'store'])
          ->name('avant-apres.store');
        Route::delete('/avant-apres/{avantApres}', [\App\Http\Controllers\Estheticienne\AvantApresController::class, 'destroy'])
          ->name('avant-apres.destroy');
        Route::get('/avis', [\App\Http\Controllers\Estheticienne\AvisController::class, 'index'])
          ->name('avis.index');


    });

// ========================================================================
// CLIENT
// ========================================================================
Route::middleware(['auth', 'verified', 'client'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/services', [\App\Http\Controllers\Client\ServiceController::class, 'index'])
            ->name('services.index');
        Route::get('/services/{service}', [\App\Http\Controllers\Client\ServiceController::class, 'show'])
            ->name('services.show');

        Route::get('/estheticiennes/{estheticienne}', [\App\Http\Controllers\Client\EstheticienneController::class, 'show'])
            ->name('estheticiennes.show');


        // Réservation multi-services - AJAX endpoints (DOIVENT être AVANT le store)
        Route::post('/reservation/esthes-competentes', [\App\Http\Controllers\Client\ReservationController::class, 'esthesCompetentes'])
            ->name('reservation.esthes-competentes');
        Route::post('/reservation/creneaux', [\App\Http\Controllers\Client\ReservationController::class, 'creneaux'])
            ->name('reservation.creneaux');

        // Réservation multi-services - workflow principal
        Route::get('/reservation', [\App\Http\Controllers\Client\ReservationController::class, 'create'])
            ->name('reservation.create');
        Route::post('/reservation/store', [\App\Http\Controllers\Client\ReservationController::class, 'store'])
            ->name('reservation.store');

        Route::get('/rendez-vous', [\App\Http\Controllers\Client\RendezVousController::class, 'index'])
            ->name('rendez-vous.index');
        Route::get('/rendez-vous/{rendezVous}', [\App\Http\Controllers\Client\RendezVousController::class, 'show'])
            ->name('rendez-vous.show');
        Route::patch('/rendez-vous/{rendezVous}/annuler', [\App\Http\Controllers\Client\RendezVousController::class, 'annuler'])
            ->name('rendez-vous.annuler');

        Route::get('/produits', [\App\Http\Controllers\Client\ProduitController::class, 'index'])
           ->name('produits.index');
        Route::get('/produits/{produit}', [\App\Http\Controllers\Client\ProduitController::class, 'show'])
           ->name('produits.show');

        Route::get('/panier', [\App\Http\Controllers\Client\PanierController::class, 'index'])
           ->name('panier.index');
        Route::post('/panier/{produit}/ajouter', [\App\Http\Controllers\Client\PanierController::class, 'ajouter'])
           ->name('panier.ajouter');
        Route::patch('/panier/{produit}/modifier', [\App\Http\Controllers\Client\PanierController::class, 'modifier'])
           ->name('panier.modifier');
        Route::delete('/panier/{produit}/retirer', [\App\Http\Controllers\Client\PanierController::class, 'retirer'])
           ->name('panier.retirer');
        Route::delete('/panier/vider', [\App\Http\Controllers\Client\PanierController::class, 'vider'])
           ->name('panier.vider');

        Route::get('/favoris', [\App\Http\Controllers\Client\FavorisController::class, 'index'])
           ->name('favoris.index');
        Route::post('/favoris/{produit}/toggle', [\App\Http\Controllers\Client\FavorisController::class, 'toggle'])
           ->name('favoris.toggle');

        Route::get('/commandes', [\App\Http\Controllers\Client\CommandeController::class, 'index'])
           ->name('commandes.index');
        Route::post('/commandes', [\App\Http\Controllers\Client\CommandeController::class, 'store'])
           ->name('commandes.store');
        Route::get('/commandes/{commande}', [\App\Http\Controllers\Client\CommandeController::class, 'show'])
           ->name('commandes.show');
        Route::patch('/commandes/{commande}/annuler', [\App\Http\Controllers\Client\CommandeController::class, 'annuler'])
           ->name('commandes.annuler');

        Route::get('/factures', [\App\Http\Controllers\Client\FactureController::class, 'index'])
           ->name('factures.index');
        Route::get('/factures/{facture}', [\App\Http\Controllers\Client\FactureController::class, 'show'])
           ->name('factures.show');
        Route::get('/factures/{facture}/telecharger', [\App\Http\Controllers\Client\FactureController::class, 'telecharger'])
           ->name('factures.telecharger');
        Route::get('/avis', [\App\Http\Controllers\Client\AvisController::class, 'index'])
           ->name('avis.index');
        Route::get('/avis/institut', [\App\Http\Controllers\Client\AvisController::class, 'createInstitut'])
           ->name('avis.create-institut');
        Route::post('/avis/institut', [\App\Http\Controllers\Client\AvisController::class, 'storeInstitut'])
           ->name('avis.store-institut');
        Route::get('/avis/esthe/{rendezVous}', [\App\Http\Controllers\Client\AvisController::class, 'createEsthe'])
          ->name('avis.create-esthe');
        Route::post('/avis/esthe/{rendezVous}', [\App\Http\Controllers\Client\AvisController::class, 'storeEsthe'])
          ->name('avis.store-esthe');
        Route::patch('/avis/{avi}', [\App\Http\Controllers\Client\AvisController::class, 'modifier'])
          ->name('avis.modifier');
        Route::delete('/avis/{avi}', [\App\Http\Controllers\Client\AvisController::class, 'supprimer'])
          ->name('avis.supprimer');
        Route::get('/recommandations', [\App\Http\Controllers\Client\RecommandationController::class, 'index'])
          ->name('recommandations.index');
        Route::post('/recommandations/type-peau', [\App\Http\Controllers\Client\RecommandationController::class, 'updateTypePeau'])
          ->name('recommandations.update');
        Route::get('/fidelite', [\App\Http\Controllers\Client\FideliteController::class, 'index'])
          ->name('fidelite.index');
        Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])
          ->name('contact.index');
        Route::post('/contact', [\App\Http\Controllers\Client\ContactController::class, 'store'])
          ->name('contact.store');
        Route::get('/galerie', [\App\Http\Controllers\Client\AvantApresController::class, 'index'])
          ->name('galerie.index');
        Route::get('/questionnaire', [\App\Http\Controllers\Client\QuestionnaireController::class, 'index'])
          ->name('questionnaire.index');
        Route::post('/questionnaire', [\App\Http\Controllers\Client\QuestionnaireController::class, 'analyser'])
          ->name('questionnaire.analyser');
    });

    Route::get('/register/verify-otp', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'showVerifyOtp'])
      ->name('register.verify.otp')->middleware('guest');
    Route::post('/register/verify-otp', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'verifyOtp'])
      ->name('register.verify.otp.submit')->middleware('guest');
    Route::post('/register/resend-otp', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'resendOtp'])
      ->name('register.resend.otp')->middleware('guest');

    Route::get('/register-estheticienne/verify-otp', [\App\Http\Controllers\Auth\RegisteredEstheticienneController::class, 'showVerifyOtp'])
       ->name('register.esthe.verify.otp')->middleware('guest');
    Route::post('/register-estheticienne/verify-otp', [\App\Http\Controllers\Auth\RegisteredEstheticienneController::class, 'verifyOtp'])
       ->name('register.esthe.verify.otp.submit')->middleware('guest');
    Route::post('/register-estheticienne/resend-otp', [\App\Http\Controllers\Auth\RegisteredEstheticienneController::class, 'resendOtp'])
       ->name('register.esthe.resend.otp')->middleware('guest');

require __DIR__.'/auth.php';
