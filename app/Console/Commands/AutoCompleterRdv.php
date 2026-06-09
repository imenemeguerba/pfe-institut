<?php

namespace App\Console\Commands;

use App\Models\RendezVous;
use App\Services\FideliteService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoCompleterRdv extends Command
{
    protected $signature   = 'rdv:auto-complete';
    protected $description = 'Auto-complete confirmed appointments that ended more than 1 hour ago';

    public function handle(): void
    {
        $limite = Carbon::now()->subHour();

        $rdvs = RendezVous::where('statut', 'confirme')
            ->where('date_fin', '<=', $limite)
            ->with(['client', 'estheticienne'])
            ->get();

        foreach ($rdvs as $rdv) {
            $rdv->update(['statut' => 'termine']);

            // Points fidélité
            try {
                FideliteService::ajouterPourRdv($rdv->client, $rdv);
            } catch (\Exception $e) {}

            // Notification client
            try {
                $rdv->client->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'rdv_termine',
                    'data'    => json_encode([
                        'message' => "✅ Your appointment on {$rdv->date_debut->format('d/m/Y at H:i')} has been automatically marked as completed. Your invoice is available.",
                    ]),
                    'read_at' => null,
                ]);
            } catch (\Exception $e) {}
        }

        $this->info("Auto-completed {$rdvs->count()} appointment(s).");
    }
}
