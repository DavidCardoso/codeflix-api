<?php

$iconBack = Icon::create('chevron-left');

$tabs = [
    [
        'title' => 'Informações',
        'link' => !isset($video) ? route('admin.videos.create') : route('admin.videos.edit', ['video' => $video->id])
    ],
    [
        'title' => 'Vinculos',
        'link' => !isset($video) ? '#' : route('admin.videos.relations.create', ['video' => $video->id]),
        'disable' => !isset($video) ? true : false
    ],
    [
        'title' => 'Arquivos',
        'link' => '',
        'disable' => !isset($video) ? true : false
    ]
];

?>
<div class="row">
    <h3>Gerenciar vídeo</h3>
</div>

<div class="row text-right">
    {!! Button::link($iconBack.' Listar vídeos')->asLinkTo(route('admin.videos.index')) !!}
</div>

<div class="row">
    {!! Navigation::tabs($tabs) !!}
</div>

<div>
    {!! $slot !!}
</div>