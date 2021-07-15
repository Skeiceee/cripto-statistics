<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('img/logo.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('img/logo.png') }}" sizes="192x192">
    <link href="{{ asset('css/hamburgers.min.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Cripto') }}</title>
</head>
<body>
 <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-0" style="height: 56px">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Vozdigital" height="40">
                    <div class="d-inline-block align-top pt-2 pl-1 font-weight-bold text-uppercase">Cripto</div>
                </a>

                <ul class="navbar-nav mr-4">
                    <div id="menu_toggle" class="tray" style="width: 40px; height: 40px;">
                        <div id="hamburger" class="hamburger hamburger--squeeze p-0 pt-2 ">
                            <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </ul>

            </div>
        </nav>
        <main>
            @include('layouts.menu')
            @yield('content')
        </main>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    @stack('scripts')
</body>
</html>