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
        {{-- Configuring NavBar --}}
        <?php
            $navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
            if(Auth::check()){
                $arrayLinksLeft = [
                    ['link' => route('admin.users.index'), 'title' => 'Usuário'],
                ];
                $arrayLinksRight = [
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => route('admin.logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                    'onclick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                                ]
                            ],
                        ]
                    ],
                ];
                $menusLeft = Navigation::links($arrayLinksLeft);
                $menusRight = Navigation::links($arrayLinksRight)->right();
                $navbar->withContent($menusLeft)->withContent($menusRight);
            }
        ?>
        {{-- Invoking NavBar --}}
        {!! $navbar !!}

        {{-- Configuring Form Logout --}}
        <?php
            $formLogout = FormBuilder::plain([
                'id' => 'form-logout',
                'route' => ['admin.logout'], // array because it can use arguments too
                'method' => 'POST',
                'style' => 'display:none'
            ]);
        ?>
        {{-- Invoking Form Logout --}}
        {!! form($formLogout) !!}

        {{-- Alerts by Session Flash Message (success, warning, danger, info, primary, default) --}}
        @if(Session::has('success'))
            <div class="container">
                {!! Alert::success(Session::get('success'))->close() !!}
            </div>
        @endif

        {{-- Main block code of the page --}}
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
