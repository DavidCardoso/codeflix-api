<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Forms\UserSettingsForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UserSettingsController
 * @package CodeFlix\Http\Controllers
 */
class UserSettingsController extends Controller
{
    /** @var UserRepository */
    private $repository;

    /**
     * UserSettingsController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        /** @var \Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user-settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.auth.setting', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /** @var \Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class);

        if (!$form->isValid()) {
            $request->session()->flash('error', 'Dados <b>não</b> alterados!');
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, \Auth::user()->id);

        $request->session()->flash('success', 'Dados <b>alterados</b> com sucesso!');
        return redirect()->route('admin.user-settings.edit');
    }

}
