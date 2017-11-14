<?php

namespace CodeFlix\Repositories;

use Jrean\UserVerification\Facades\UserVerification;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * @param array $attributes
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @throws \Jrean\UserVerification\Exceptions\ModelNotCompliantException
     */
    public function create(array $attributes)
    {
        $attributes['role'] = User::ROLE_ADMIN;
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        UserVerification::generate($model);
        UserVerification::send($model, '['.config('app.name').'] Verificação de e-mail');

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
