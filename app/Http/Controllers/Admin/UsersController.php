<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\UserForm;
use CodeFlix\Models\User;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);

        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class);

        // validating request
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        // creating new register
        $data = $form->getFieldValues();
        $this->repository->create($data);

        // returning message using Session
        \Session::flash('success', 'Usuário <b>criado</b> com sucesso!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);

        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $id]
        ]);

        // validating request
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        // updating register
        $data = array_except($form->getFieldValues(), ['password', 'role']);
        $this->repository->update($data, $id);

        // returning message using Session
        // \Session::flash('success', 'Usuário alterado com sucesso!');
        $request->session()->flash('success', 'Usuário <b>alterado</b> com sucesso!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        // returning message using Session
        \Session::flash('success', 'Usuário <b>excluído</b> com sucesso!');

        return redirect()->route('admin.users.index');
    }
}
