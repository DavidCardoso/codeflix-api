@extends('layouts.admin')

@section('title')
    <title>Novo vídeo | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    {{-- Creating icon with Bootstrapper --}}
    <?php $icon = Icon::create('floppy-disk').' Salvar';?>

    <div class="container">
        @component('admin.videos.tabs-component', ['video' => $form->getModel()])
            <div class="col-md-12">
                <div class="row">
                    <h4>Editar vinculos</h4>
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
        @endcomponent
    </div>
@endsection
