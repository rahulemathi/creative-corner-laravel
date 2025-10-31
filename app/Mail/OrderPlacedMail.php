<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your order #'.$this->order->id.' has been placed',
        );
    }

    public function content(): Content
    {
        // Use a dedicated order placed template that follows the welcome style
        return new Content(
            view: 'emails.order-placed',
            with: [
                'user' => $this->order->user,
                'order' => $this->order,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}


