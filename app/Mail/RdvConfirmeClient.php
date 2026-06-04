<?php

namespace App\Mail;

use App\Models\RendezVous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RdvConfirmeClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public RendezVous $rdv,
        public ?string $facturePath = null,
        public ?string $factureNumero = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '✅ Your appointment is confirmed — Glow Institute');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.rdv-confirme-client');
    }

    public function attachments(): array
    {
        if ($this->facturePath && file_exists(storage_path('app/public/' . $this->facturePath))) {
            return [
                Attachment::fromPath(storage_path('app/public/' . $this->facturePath))
                    ->as(($this->factureNumero ?? 'facture') . '.pdf')
                    ->withMime('application/pdf'),
            ];
        }
        return [];
    }
}