<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Cliente;

class NovoClienteMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public $cliente, public $password)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('app.name')),
            subject: 'Seu acesso ao sistema de Rifa Online.',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.mails.novo_cliente',
            with: [
                'cliente' => $this->cliente,
                'password' => $this->password
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
