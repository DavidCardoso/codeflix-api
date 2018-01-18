@extends('layouts.admin')

@section('title')
    <title>User Settings | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar meus dados de usuário</h3>
            {{-- Creating Icon with Bootrapper --}}
            <?php $icon = \Icon::create('floppy-disk');?>
            {{-- Rendering form with FormBuilder --}}
            {!!
                form($form->add('salvar', 'submit', [
                    'attr' => ['class' => 'btn btn-success btn-block'],
                    'label' => $icon
                ]
                ))
             !!}
        </div>
    </div>
@endsection
