@extends('layouts.admin')

@section('content')
    <?php $icon = Icon::create('floppy-disk');?>

    <div class="container">
        <div class="row">
            <h3>Novo usuário</h3>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {!!
                form($form->add('salvar', 'submit', [
                    'attr' => ['class' => 'btn btn-success btn-block'],
                    'label' => $icon
                ]))
             !!}

        </div>
    </div>
@endsection
