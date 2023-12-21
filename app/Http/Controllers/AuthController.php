<?php

namespace App\Http\Controllers;

use App\Http\Managements\ExitManagement;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class AuthController
{
    /**
     * @var UserRepository
     */
    public UserRepository $userRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param LoginAuthRequest $request
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        $user = $this->userRepository->getByEmail($request->email);
        if (!($user && md5($request->password) == $user->password)) {
            return ExitManagement::error('Bilgilerinizi kontrol etmelisiniz !');
        }
        $token = (string)Str::uuid();
        Cache::put('bearer' . $user->id, $token);

        return ExitManagement::ok($token);
    }


    public function details()
    {
        return ExitManagement::ok();
    }
}
