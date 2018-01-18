@extends('layouts.admin')

@section('title')
    <title>Série | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')

    {{-- Creating icon with Bootstrapper --}}
    <?php $iconEdit = Icon::create('pencil');?>
    <?php $iconDestroy = Icon::create('remove');?>

    {{-- Creating form with FormBuilder --}}
    <?php $formDelete = FormBuilder::plain([
        'id' => 'form-delete',
        'route' => [
            'admin.series.destroy',
            'series' => $series->id
        ],
        'method' => 'DELETE',
        'style' => 'display:none'
    ]);?>
    {{-- Rendering form --}}
    {!! form($formDelete) !!}

    <div class="container">
        <div class="row">
            <h3>Série</h3>
        </div>

        <div class="row">
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.series.edit', ['series' => $series->id])) !!}
            {!!
                Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.series.destroy', ['series' => $series->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
        </div>

        <br>

        <div class="row">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{ $series->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{ $series->title }}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{ $series->description }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
