<?php

namespace App\Services;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UserService
{
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function userExists(Request $request)
    {
        if ($request->has('username')) {
            return response()->json(User::where('name', $request->input('username'))->exists());
        }
        if ($request->has('email')) {
            return response()->json(User::where('email', $request->input('email'))->exists());
        }

        return response()->json(false);
    }
}
