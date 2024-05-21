<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;
use QrCode;

class Reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emailのreminder送信';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $reservations = Reservation::with('user')->where('date', $today)->get();

        foreach($reservations as $reservation) {

            $qrCode = base64_encode(QrCode::format('png')->encoding('UTF-8')
            ->generate(
                $reservation->user->name . '/' .
                $reservation->date . '/' .
                $reservation->time . '/' .
                $reservation->number));

            Mail::send(new ReminderMail($reservation, $qrCode));
        }
    }
}
