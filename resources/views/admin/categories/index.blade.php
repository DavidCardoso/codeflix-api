@extends('layouts.admin')

@section('title')
    <title>Categorias | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de categorias</h3>
        </div>

        <div class="row">
            {{-- Creating icon with Bootstrapper --}}
            <?php $iconCreate = Icon::create('plus');?>
            {{-- Rendering button with Bootstrapper --}}
            {!! Button::primary($iconCreate.' Nova categoria')->asLinkTo(route('admin.categories.create')) !!}
        </div>

        <div class="row">
            {{-- Redering table with Bootstrapper --}}
            {!!
                Table::withContents($categories->items())
                    ->striped()
                    ->callback('Opções', function($field, $category){
                        $linkEdit = route('admin.categories.edit', ['category' => $category->id]);
                        $linkShow = route('admin.categories.show', ['category' => $category->id]);
                        return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        <div class="row">
            {{-- Pagination --}}
            {!! $categories->links() !!}
        </div>

    </div>
@endsection

@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(2){
            width: 70%;
        }
    </style>
@endpush
