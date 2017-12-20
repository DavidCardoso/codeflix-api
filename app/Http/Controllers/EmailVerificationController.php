<?php

namespace CodeFlix\Http\Controllers;

use CodeFlix\Repositories\UserRepository;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{
    use VerifiesUsers;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * EmailVerificationController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Do auto login
     */
    protected function loginUser()
    {
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        \Auth::login($user);
    }

    /**
     * Get the redirect path for a successful verification token verification.
     *
     * @return string
     */
    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('admin.user-settings.edit');
    }

}
