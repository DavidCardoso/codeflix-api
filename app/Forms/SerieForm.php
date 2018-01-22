<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $rulesThumbFile = 'image|max:1024';
        $rulesThumbFile = !$id ? 'required|'.$rulesThumbFile : $rulesThumbFile;

        $this
            ->add('title','text',[
                'label' => 'Título',
                'rules' => 'required|min:3|max:255'
            ])
            ->add('description', 'textarea',[
                'label' => 'Descrição',
                'rules' => 'required|min:5|max:255'
            ])
            ->add('thumb_file', 'file',[
                'label' => 'Thumbnail',
                'rules' => $rulesThumbFile,
                'required' => !$id ? true : false
            ]);
    }
}
