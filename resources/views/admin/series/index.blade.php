@extends('layouts.admin')

@section('title')
    <title>Séries | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de séries</h3>
        </div>

        <div class="row">
            {{-- Rendering button with Bootstrapper --}}
            {!! Button::primary('Nova série')->asLinkTo(route('admin.series.create')) !!}
        </div>

        <div class="row">
            {{-- Redering table with Bootstrapper --}}
            {!!
                Table::withContents($series->items())
                    ->striped()
                    ->callback('Opções', function($field, $series){
                        $linkEdit = route('admin.series.edit', ['series' => $series->id]);
                        $linkShow = route('admin.series.show', ['series' => $series->id]);
                        return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        <div class="row">
            {{-- Pagination --}}
            {!! $series->links() !!}
        </div>

    </div>
@endsection

@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(3){
            width: 50%;
        }
    </style>
@endpush
