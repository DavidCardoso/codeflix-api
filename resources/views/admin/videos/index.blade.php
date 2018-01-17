@extends('layouts.admin')

@section('title')
    <title>Vídeos | {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de vídeos</h3>
        </div>

        <div class="row">
            {{-- Creating icon with Bootstrapper --}}
            <?php $iconCreate = Icon::create('plus');?>
            {{-- Rendering button with Bootstrapper --}}
            {!! Button::primary($iconCreate.' Novo vídeo')->asLinkTo(route('admin.videos.create')) !!}
        </div>

        <div class="row">
            {{-- Rendering table with Bootstrapper --}}
            {!!
                Table::withContents($videos->items())
                    ->striped()
                    ->callback('Descrição', function ($field, $video){
                        return MediaObject::withContents([
                            'image' => '//placehold.it/64x64',
                            'link' => '#',
                            'heading' => $video->title,
                            'body' => $video->description
                        ]);
                    })
                    ->callback('Opções', function ($field, $video){
                        $linkEdit = route('admin.videos.edit', ['video' => $video->id]);
                        $linkShow = route('admin.videos.show', ['video' => $video->id]);
                        return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                    })
            !!}
        </div>

        <div class="row">
            {{-- Pagination --}}
            {!! $videos->links() !!}
        </div>

    </div>
@endsection

@push('styles')
    <style type="text/css">
        .media-body{
            width: auto;
        }
    </style>
@endpush
