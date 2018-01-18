<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        // campos do formulário
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|min:5|max:255'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => "required|min:10|max:255|unique:users,email,$id"
            ]);
    }
}
