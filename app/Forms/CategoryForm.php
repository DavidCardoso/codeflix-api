<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        // fields form
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|min:3|max:255'
            ]);
    }
}
