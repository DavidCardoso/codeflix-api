@extends('layouts.admin')

@section('title')
    <title>Vídeo | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')

    {{-- Creating icon with Bootstrapper --}}
    <?php $iconEdit = Icon::create('pencil');?>
    <?php $iconDestroy = Icon::create('remove');?>

    {{-- Creating form with FormBuilder --}}
    <?php $formDelete = \FormBuilder::plain([
        'id' => 'form-delete',
        'route' => [
            'admin.videos.destroy',
            'video' => $video->id
        ],
        'method' => 'DELETE',
        'style' => 'display:none'
    ]);?>
    {{-- Rendering form --}}
    {!! form($formDelete) !!}

    <div class="container">
        <div class="row">
            <h3>Vídeo</h3>
        </div>

        <div class="row">
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.videos.edit', ['video' => $video->id])) !!}
            {!!
                Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.videos.destroy', ['video' => $video->id]))
                    ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById(\"form-delete\").submit();'])
            !!}
        </div>

        <br>

        <div class="row">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{ $video->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Título</th>
                        <td>{{ $video->title }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Descrição</th>
                        <td>{{ $video->description }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Duração</th>
                        <td>{{ $video->duration }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
