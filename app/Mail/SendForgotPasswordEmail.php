<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SendForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $requestData;
    /**
     * Create a new message instance.
     */
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'tusharpatel1093@gmail.com',
            replyTo: ['tusharpatel1093@gmail.com'],
            subject: 'Send Forgot Password Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: ('mails.forgot_password_email'),
            with: ([
                'token' => $this->requestData['_token'],
                'email' => $this->requestData['email']
            ])
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
