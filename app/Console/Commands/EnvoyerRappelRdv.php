<?php

namespace App\Console\Commands;

use App\Mail\RappelRdv;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnvoyerRappelRdv extends Command
{
    protected $signature   = 'rdv:rappel';
    protected $description = 'Envoyer les rappels email 24h avant chaque RDV';

    public function handle(): void
    {
        $debut = Carbon::now()->addHours(23)->addMinutes(30);
        $fin   = Carbon::now()->addHours(24)->addMinutes(30);

        $rdvs = RendezVous::with(['client', 'estheticienne', 'services'])
            ->where('statut', 'confirme')
            ->whereBetween('date_debut', [$debut, $fin])
            ->whereNull('rappel_envoye_at')
            ->get();

        foreach ($rdvs as $rdv) {
            try {
                Mail::to($rdv->client->email)->send(new RappelRdv(
                    prenom: $rdv->client->prenom,
                    dateRdv: $rdv->date_debut->format('d/m/Y'),
                    heure: $rdv->date_debut->format('H:i'),
                    estheticienne: $rdv->estheticienne->fullName(),
                    services: $rdv->services->pluck('nom')->join(', '),
                ));

                // Marquer comme envoyé
                $rdv->update(['rappel_envoye_at' => now()]);

                $this->info("Rappel envoyé à {$rdv->client->email} pour RDV #{$rdv->id}");
            } catch (\Exception $e) {
                $this->error("Erreur rappel RDV #{$rdv->id}: " . $e->getMessage());
            }
        }

        $this->info("Rappels terminés — {$rdvs->count()} email(s) traité(s).");
    }
}
