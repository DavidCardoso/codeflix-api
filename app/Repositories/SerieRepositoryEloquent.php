<?php

namespace CodeFlix\Repositories;

use CodeFlix\Media\ThumbUploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\SerieRepository;
use CodeFlix\Models\Serie;
use CodeFlix\Validators\SerieValidator;

/**
 * Class SerieRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class SerieRepositoryEloquent extends BaseRepository implements SerieRepository
{
    use ThumbUploads;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Serie::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
