<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompteActionEsthe extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $prenom,
        public string $action,
        public ?string $motif = null,
    ) {}

    public function envelope(): Envelope
    {
        $sujets = [
            'supprime'  => '🗑️ Your account has been deleted — Glow Institute',
            'desactive' => '⏸️ Your account has been deactivated — Glow Institute',
            'reactive'  => '✅ Your account has been reactivated — Glow Institute',
        ];
        return new Envelope(subject: $sujets[$this->action] ?? 'Account information — Glow Institute');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.compte-action-esthe');
    }
}