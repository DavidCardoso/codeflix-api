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
            {{-- Pegando coleção de usuários e renderizando em uma tabela --}}
            {!! Table::withContents($users->items())->striped() !!}
        </div>

        <div class="row">
            {{-- Navegação da paginação --}}
            {!! $users->links() !!}
        </div>
    </div>
@endsection
