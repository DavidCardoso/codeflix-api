@extends('layouts.admin')

@section('title')
    <title>Categoria | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')

    {{-- Creating icon with Bootstrapper --}}
    <?php $iconEdit = Icon::create('pencil');?>
    <?php $iconDestroy = Icon::create('remove');?>

    {{-- Creating form with FormBuilder --}}
    <?php $formDelete = FormBuilder::plain([
        'id' => 'form-delete',
        'route' => [
            'admin.categories.destroy',
            'category' => $category->id
        ],
        'method' => 'DELETE',
        'style' => 'display:none'
    ]);?>
    {{-- Rendering form --}}
    {!! form($formDelete) !!}

    <div class="container">
        <div class="row">
            <h3>Categoria</h3>
        </div>

        <div class="row">
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.categories.edit', ['category' => $category->id])) !!}
            {!!
                Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.categories.destroy', ['category' => $category->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
        </div>

        <br>

        <div class="row">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{ $category->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
