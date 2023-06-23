<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        $this->from($this->mailData['from']);
    }

    public function build()
    {
        return $this->subject($this->mailData['subject'])
            ->cc(isset($mailData['cc']) ? $mailData['cc'] : '')
            ->bcc(isset($mailData['bcc']) ? $mailData['bcc'] : '')
            ->view('admin.view.mail.template', ['data' => $this->mailData['data']]);
    }
}
