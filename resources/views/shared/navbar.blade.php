{{-- Configuring NavBar --}}
<?php
$navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
if(Auth::check()){
    $arrayLinksLeft = [
        ['link' => route('admin.users.index'), 'title' => 'Usuário'],
        ['link' => route('admin.categories.index'), 'title' => 'Categoria'],
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
                [
                    'link' => route('admin.user-settings.edit'),
                    'title' => 'Meus dados'
                ]
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