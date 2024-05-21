<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $qrCode)
    {
        $this->name = $reservation->user->name;
        $this->email = $reservation->user->email;
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
        ->subject('本日はご予約日です')
        ->view('admin.reminder-mail')
        ->with([
                'name' => $this->name,
                'qrCode' => $this->qrCode,
            ]);
    }
}
