<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoForm;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class VideosController extends Controller
{
    /** @var VideoRepository $repository */
    private $repository;

    /**
     * VideosController constructor.
     * @param VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
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
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var \FormBuilder $form */
        $form = \FormBuilder::create(VideoForm::class, [
           'url' => route('admin.videos.store'),
           'method' => 'POST'
        ]);
        return view('admin.videos.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var \FormBuilder $form */
        $form = \FormBuilder::create(VideoForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $video = $this->repository->create($data);
        $request->session()->flash('success', 'Vídeo <b>cadastrado</b> com sucesso!');

        return redirect()->route('admin.videos.edit',['video' => $video->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        /** @var \FormBuilder $form */
        $form = \FormBuilder::create(VideoForm::class, [
           'url' => route('admin.videos.update', ['video' => $video->id]),
           'method' => 'PUT',
           'model' => $video
        ]);

        return view('admin.videos.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        /** @var \FormBuilder $form */
        $form = \FormBuilder::create(VideoForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('success', 'Vídeo <b>atualizado</b> com sucesso!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
