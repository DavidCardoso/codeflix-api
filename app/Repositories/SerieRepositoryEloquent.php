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
     * @param array $attributes
     * @return mixed
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function create(array $attributes)
    {
        $model = parent::create(array_except($attributes, 'thumb_file'));
        $this->uploadThumb($model->id, $attributes['thumb_file']);
        return $model;
    }


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
