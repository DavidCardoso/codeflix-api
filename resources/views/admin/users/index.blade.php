@extends('layouts.admin')

@section('title')
    <title>Usuários | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <h1>Listagem de Usuários</h1>
        </div>

        <div class="row">
            {!! Button::primary('Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>

        <div class="row">
            {{-- Pegando coleção de usuários e renderizando em uma tabela --}}
            {!!
                Table::withContents($users->items())
                    ->striped()
                    ->callback('Opções', function($field, $user){
                        $linkEdit = route('admin.users.edit', ['user' => $user->id]);
                        return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit);
                    })
            !!}
        </div>

        <div class="row">
            {{-- Navegação da paginação --}}
            {!! $users->links() !!}
        </div>

    </div>
@endsection
