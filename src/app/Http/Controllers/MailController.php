<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;
use App\Models\User;
use App\Models\Reservation;
use QrCode;

class MailController extends Controller
{
    public function send(MailRequest $request) {
        $reserved = Reservation::find($request->reservationId);
        $user = User::find($reserved['user_id']);
        $qrCode = base64_encode(QrCode::format('png')->encoding('UTF-8')
        ->generate($user['name'] . '/' . $reserved['date'] . '/' . $reserved['time'] . '/' . $reserved['number']));

        Mail::send(new NoticeMail($user, $qrCode));

        return redirect()->route('managerReservation', [ 'store' => $reserved['shop_id'] ])->with('message', '送信完了しました');
    }
}
