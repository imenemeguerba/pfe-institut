<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RappelRdv extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $prenom,
        public string $dateRdv,
        public string $heure,
        public string $estheticienne,
        public string $services,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '⏰ Reminder: Your appointment tomorrow — Glow Institute');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.rappel-rdv');
    }
}