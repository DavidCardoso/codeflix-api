<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title of the page --}}
    @yield('title')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Stack of code blocks inserted from the Views --}}
    @stack('styles')
</head>
<body>
    <div id="app">

        {{-- NavBar --}}
        @include('shared.navbar')

        {{-- Connection status --}}
        @include('shared.connection_status')

        {{-- Errors --}}
        @include('shared.alerts')

        {{-- Main block code of the page --}}
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        // checking connection status
        setInterval(function () {
            document.getElementById("statusConnection").style.display = navigator.onLine ? 'none' : '';
        }, 3000);
    </script>

    {{-- Stack of code blocks inserted from the Views --}}
    @stack('scripts')
</body>
</html>
