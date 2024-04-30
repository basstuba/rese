<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body class="body">
    <header>
        <div class="header">
            <div class="header-content">
                <div class="header-item">
                    <a class="modal-link" href="#menu"><span class="decoration"></span></a>
                </div>
                <div class="header-title">
                    <h1 class="header-logo">Rese</h1>
                </div>
            </div>
            <div class="search-frame">
                @yield('search')
            </div>
        </div>
        @yield('modal')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>