<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Demande de réservation reçue — Chez Théo les Bains',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-client',
            with: ['data' => $this->data],
        );
    }
}
