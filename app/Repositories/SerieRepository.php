<?php

namespace CodeFlix\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace CodeFlix\Repositories;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb($id, UploadedFile $file): Model;
}
