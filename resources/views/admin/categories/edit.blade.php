@extends('layouts.admin')

@section('title')
    <title>Editar categoria | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    {{-- Creating icon with Bootstrapper --}}
    <?php $icon = Icon::create('pencil')." Salvar";?>

    <div class="container">
        <div class="row">
            <h3>Editar categoria</h3>
        </div>

        <div class="row">
            {{-- Rendering form with FormBuilder --}}
            {!!
                form($form->add('salvar', 'submit', [
                        'attr' => ['class' => 'btn btn-success btn-block'],
                        'label' => $icon
                ]))
             !!}
        </div>
    </div>
@endsection
