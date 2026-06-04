<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeAnnuleeClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Commande $commande) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your order ' . $this->commande->numero . ' has been cancelled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.commandes.annulee',
        );
    }
}
