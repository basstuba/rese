<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserved, $qrCode)
    {
        $this->name = $reserved->user->name;
        $this->email = $reserved->user->email;
        $this->qrCode = $qrCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
        ->subject('ご予約ありがとうございます')
        ->view('admin.mail')
        ->with([
                'name' => $this->name,
                'qrCode' => $this->qrCode,
            ]);
    }
}
