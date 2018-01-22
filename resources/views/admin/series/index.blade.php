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
            {{-- Creating icon with Bootstrapper --}}
            <?php $iconCreate = Icon::create('plus');?>
            {{-- Rendering button with Bootstrapper --}}
            {!! Button::primary($iconCreate.' Nova série')->asLinkTo(route('admin.series.create')) !!}
        </div>

        <div class="row">
            {{-- Rendering table with Bootstrapper --}}
            {!!
                Table::withContents($series->items())
                    ->striped()
                    ->callback('Descrição', function ($field, $series){
                        return MediaObject::withContents([
                            'image' => $series->thumb_small_asset,
                            'link' => '#',
                            'heading' => $series->title,
                            'body' => $series->description
                        ]);
                    })
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
        table > thead > tr > th:nth-child(2){
            width: 70%;
        }
    </style>
@endpush
