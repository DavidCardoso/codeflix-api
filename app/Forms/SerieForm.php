<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
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
                'rules' => 'required|image|max:1024'
            ]);
    }
}
