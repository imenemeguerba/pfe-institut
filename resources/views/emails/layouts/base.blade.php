<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienvenuClient extends Mailable {
    use Queueable, SerializesModels;
    public function __construct(public string $prenom) {}
    public function envelope(): Envelope {
        return new Envelope(subject: '🌸 Welcome to Glow Institute!');
    }
    public function content(): Content {
        return new Content(view: 'emails.bienvenu-client');
    }
}