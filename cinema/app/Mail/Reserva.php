<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reserva extends Mailable
{
    use Queueable, SerializesModels;

    // public $email;
    // public $nome;
    // public $sala;
    // public $horario;
    // public $date;
    // public $filme;
    // public $assentos;

    /**
     * Create a new message instance.
     */
    public function __construct(public readonly array $data)
    {
        // $this->email = $data['email'];
        // $this->nome = $data['nome'];
        // $this->sala = $data['sala'];
        // $this->horario = $data['horario'];
        // $this->date = $data['data'];
        // $this->filme = $data['filme'];
        // $this->assentos = $data['assentos'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:new Address($this->data['email'], $this->data['nome']),
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.reserva', 
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
