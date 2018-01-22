<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\SerieForm;
use CodeFlix\Models\Serie;
use CodeFlix\Repositories\SerieRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\Form;

class SeriesController extends Controller
{

    /** @var SerieRepository */
    private $repository;

    /**
     * SeriesController constructor.
     * @param SerieRepository $repository
     */
    public function __construct(SerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $series = $this->repository->paginate();
        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.store'),
            'method' => 'POST',
        ]);

        return view('admin.series.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class);

        // validating request
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        // creating new register
        $data = $form->getFieldValues();
        $data['thumb'] = env('IMAGE_NO_THUMB');
        Model::unguard();
        $this->repository->create($data);

        // returning message using Session
        $request->session()->flash('success', 'Série <b>criada</b> com sucesso!');

        return redirect()->route('admin.series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Serie  $series
     * @return View
     */
    public function show(Serie $series): View
    {
        return view('admin.series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Serie  $series
     * @return View
     */
    public function edit(Serie $series): View
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.update', ['series' => $series->id]),
            'method' => 'PUT',
            'model' => $series
        ]);

        return view('admin.series.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class);

        // validating request
        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        // updating register
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);

        // returning message using Session
        // \Session::flash('success', 'Série alterada com sucesso!');
        $request->session()->flash('success', 'Série <b>alterada</b> com sucesso!');

        return redirect()->route('admin.series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);

        // returning message using Session
        \Session::flash('success', 'Série <b>excluída</b> com sucesso!');

        return redirect()->route('admin.series.index');
    }

    /**
     * @param Serie $serie
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function thumbAsset(Serie $serie): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download($serie->thumb_path);
    }

    /**
     * @param Serie $serie
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function thumbSmallAsset(Serie $serie): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download($serie->thumb_small_path);
    }
}
