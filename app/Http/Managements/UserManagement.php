<?php

namespace App\Http\Managements;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class UserManagement
{

    public function checkPassword($user, $requestPassword)
    {
        if (!($user && md5($requestPassword) == $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Bilgilerinizi kontrol etmelisiniz !'],
                'password' => ['Bilgilerinizi kontrol etmelisiniz !'],
            ]);
        }
    }
}
