<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QueryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contact $contact)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Form Submission from ' . $this->contact->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.querymail',
            with: [
                'name' => $this->contact->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
