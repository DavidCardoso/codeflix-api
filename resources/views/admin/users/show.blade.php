@extends('layouts.admin')

@section('title')
    <title>Usuário | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')

    {{-- Criando ícone via Bootstrapper --}}
    <?php $iconEdit = Icon::create('pencil');?>
    <?php $iconDestroy = Icon::create('remove');?>

    {{-- Criando formulário via FormBuilder --}}
    <?php $formDelete = FormBuilder::plain([
        'id' => 'form-delete',
        'route' => [
            'admin.users.destroy',
            'user' => $user->id
        ],
        'method' => 'DELETE',
        'style' => 'display:none'
    ]);?>

    {!! form($formDelete) !!}

    <div class="container">
        <div class="row">
            <h3>Usuário</h3>
        </div>

        <div class="row">
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.users.edit', ['user' => $user->id])) !!}
            {!!
                Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.users.destroy', ['user' => $user->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
        </div>

        <br>

        <div class="row">

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{ $user->email }}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
@endsection
