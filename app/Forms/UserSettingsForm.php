<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

/**
 * Class UserSettingsForm
 * @package CodeFlix\Forms
 */
class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password', [
                'rules' => 'required|min:6|max:16|confirmed',
                'label' => 'Senha'
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Confirme a senha'
            ]);
    }
}
