<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;
use App\Models\Reservation;
use QrCode;

class MailController extends Controller
{
    public function send(MailRequest $request) {
        $reserved = Reservation::with('user')->find($request->reservationId);
        $qrCode = base64_encode(QrCode::format('png')->encoding('UTF-8')
        ->generate(
            $reserved->user->name . '/' .
            $reserved->date . '/' .
            $reserved->time . '/' .
            $reserved->number));

        Mail::send(new NoticeMail($reserved, $qrCode));

        return redirect()->route('managerReservation', [ 'store' => $reserved['shop_id'] ])->with('message', '送信完了しました');
    }
}
