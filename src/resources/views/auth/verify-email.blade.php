<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmMail</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}"/>
</head>
<body class="body">
    <div class="main">
        <div class="main-title">
            <h2 class="main-title__logo">確認用メールをお送りしました</h2>
        </div>
        <div class="main-content">
            <div class="message-again">
                @if (session('status') == 'verification-link-sent')
                確認用メールを再度お送りしました
                @endif
                &emsp;
            </div>
            <div class="message">
                メールをご確認ください。もし確認用メールが届いていない場合は、下記をクリックしてください。
            </div>
            <form class="message-form" action="/email/verification-notification" method="post">
                @csrf
                <button class="message-form__button" type="submit">確認用メールを再送信する</button>
            </form>
        </div>
    </div>
</body>
</html>