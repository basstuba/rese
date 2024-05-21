<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReminderMail</title>
    <style>
        .mail-name {
            font-size: x-large;
        }
        .mail-qr {
            margin: 1rem;
        }
    </style>
</head>
<body>
    <div class="mail-content">
        <div class="mail-name">{{ $name . '様' }}</div>
        <div class="mail-text">
            <p class="mail-text__main">
                この度はご予約いただき誠にありがとうございます。<br>
                本日はご予約いただいた日になります。<br>
                ご来店の際はお手数をおかけしますがこちらのQRコードをスタッフに提示してください。
            </p>
        </div>
    </div>
    <div class="mail-qr">
        <img class="mail-image" src="data:image/png;base64, {{ $qrCode }} ">
    </div>
    <div class="mail-after">
        {{ $name . '様'}}のご来店をスタッフ一同心よりお待ちしております。
    </div>
</body>
</html>