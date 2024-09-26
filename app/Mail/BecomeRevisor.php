<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Queue\ShouldQueue;


class BecomeRevisor extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $description;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $description)
    {
        $this->user = $user;
        $this->description = $description;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@presto.it', 'Team Revisione'),
            subject: 'Diventa un Revisore',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.revisor-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
