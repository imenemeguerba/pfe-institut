<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeConfirmeeClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Commande $commande,
        public ?string $facturePath = null,
        public ?string $factureNumero = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '📦 Your order has been confirmed — Glow Institute');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.commande-confirmee-client');
    }

    public function attachments(): array
    {
        if ($this->facturePath && file_exists(storage_path('app/public/' . $this->facturePath))) {
            return [
                Attachment::fromPath(storage_path('app/public/' . $this->facturePath))
                    ->as(($this->factureNumero ?? 'invoice') . '.pdf')
                    ->withMime('application/pdf'),
            ];
        }
        return [];
    }
}