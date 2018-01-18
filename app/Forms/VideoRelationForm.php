<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('serie_id', 'entity', [
                'label' => 'Serie',
                'class' => Serie::class,
                'property' => 'title',
                'empty_value' => 'Selecione uma serie...',
                'rules' => 'nullable|exists:series,id'
            ])
            ->add('categories', 'entity', [
                'label' => 'Categorias',
                'class' => Category::class,
                'property' => 'name',
//                'selected' => $this->model->categories->pluck('id')->toArray(),
                'multiple' => true,
                'attr' => [
                    'name' => 'categories[]',
                    'style' => 'height:200px',
                    'title' => 'Segure a tecla CTRL para selecionar mais de uma opçao.'
                ],
                'rules' => 'required|exists:categories,id'
            ]);
    }
}
