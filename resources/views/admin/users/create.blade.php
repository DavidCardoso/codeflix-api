@extends('layouts.admin')

@section('title')
    <title>Novo usuário | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    {{-- Criando ícone via Bootstrapper --}}
    <?php $icon = Icon::create('floppy-disk')." Salvar";?>

    <div class="container">
        <div class="row">
            <h3>Novo usuário</h3>
        </div>

        <div class="row">

            {{-- Renderizando o formulário via FormBuilder --}}
            {!!
                form($form->add('salvar', 'submit', [
                        'attr' => ['class' => 'btn btn-success btn-block'],
                        'label' => $icon
                ]))
             !!}

        </div>
    </div>
@endsection
