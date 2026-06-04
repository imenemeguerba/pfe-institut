<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscriptionEstheRefusee extends Mailable {
    use Queueable, SerializesModels;
    public function __construct(public string $prenom, public ?string $motif = null) {}
    public function envelope(): Envelope {
        return new Envelope(subject: "❌ Your application status — Glow Institute");
    }
    public function content(): Content {
        return new Content(view: 'emails.inscription-esthe-refusee');
    }
}