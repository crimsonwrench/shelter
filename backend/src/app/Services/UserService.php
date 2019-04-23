<?php

namespace App\Services;

use Auth;
use App\User;
use App\Http\Resources\User as UserResource;

class UserService
{
    public function show(User $user)
    {
        return UserResource::make($user);
    }
}