<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\CategoryForm;
use CodeFlix\Models\Category;
use CodeFlix\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

/**
 * Class CategoriesController
 * @package CodeFlix\Http\Controllers\Admin
 */
class CategoriesController extends Controller
{
    /** @var CategoryRepository */
    private $repository;

    /**
     * CategoriesController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
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
        $categories = $this->repository->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.store'),
            'method' => 'POST',
        ]);

        return view('admin.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class);

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
        \Session::flash('success', 'Categoria <b>criada</b> com sucesso!');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.update', ['category' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);

        return view('admin.categories.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(CategoryForm::class);

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
        // \Session::flash('success', 'Categoria alterada com sucesso!');
        $request->session()->flash('success', 'Categoria <b>alterada</b> com sucesso!');

        return redirect()->route('admin.categories.index');
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
        \Session::flash('success', 'Categoria <b>excluída</b> com sucesso!');

        return redirect()->route('admin.categories.index');
    }
}
