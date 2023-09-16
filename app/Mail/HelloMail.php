<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Tambahkan variabel $user

    /**
     * Create a new message instance.
     *
     * @param  $user  \App\Models\User  // Tambahkan tipe data untuk $user
     * @return void
     */
    public function __construct($user) // Terima $user sebagai argumen
    {
        $this->user = $user; // Assign $user ke variabel $user dalam instance mailable
    }

    public function build()
    {
        return $this->view('mail.index')
            ->subject('Hello Mail')
            ->with([
                'hello' => 'Hello!',
            ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Hello Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.index',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /**
     * Send the email.
     *
     * @return void
     */
    public function sendEmail()
    {
        Mail::to($this->user->email)->send($this); // Menggunakan $this->user->email sebagai alamat email penerima
    }
}
