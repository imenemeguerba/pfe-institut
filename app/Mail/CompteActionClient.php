<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompteActionClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $prenom,
        public string $action,
        public ?string $motif = null,
    ) {}

    public function envelope(): Envelope
    {
        $sujet = $this->action === 'supprime'
            ? '🗑️ Your Glow Institute account has been deleted'
            : '🔒 Your Glow Institute account has been suspended';
        return new Envelope(subject: $sujet);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.compte-action-client');
    }
}