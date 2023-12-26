<?php

namespace App\Http\Controllers;

use App\Http\Managements\ExitManagement;
use App\Http\Managements\UserManagement;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
     * @var UserManagement
     */
    public UserManagement $userManagement;

    /**
     *
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userManagement = new UserManagement();
    }

    /**
     * @param LoginAuthRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        $user = $this->userRepository->getByEmail($request->email);
        $this->userManagement->checkPassword($user, $request->password);
        Auth::loginUsingId($user->id);
        return ExitManagement::ok($request->user()->createToken('api')->plainTextToken);
    }


    /**
     * @return JsonResponse
     */
    public function checkToken(): JsonResponse
    {
        return ExitManagement::ok([
            'user' => auth()->user(),
            'role_ids' => collect(auth()->user()->roles)->pluck('id'),
            'status' => true
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return ExitManagement::ok([
            'status' => true
        ]);
    }
}
