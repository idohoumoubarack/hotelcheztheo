<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationHotel extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🏨 Nouvelle demande de réservation — ' . $this->data['prenom'] . ' ' . $this->data['nom'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notification-hotel',
            with: ['data' => $this->data],
        );
    }
}
