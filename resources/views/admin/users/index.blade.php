@extends('layouts.admin')

@section('title')
    <title>Usuários | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de Usuários</h3>
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
                        $linkShow = route('admin.users.show', ['user' => $user->id]);
                        return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                    })

            !!}
        </div>

        <div class="row">
            {{-- Navegação da paginação --}}
            {!! $users->links() !!}
        </div>

    </div>
@endsection
