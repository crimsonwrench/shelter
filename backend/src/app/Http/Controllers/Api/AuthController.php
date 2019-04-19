<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       $request->request->add([
           'grant_type' => 'password',
           'client_id' => env('PASSPORT_CLIENT_ID'),
           'client_secret' => env('PASSPORT_CLIENT_SECRET'),
           'username' => $request->username,
           'password' => $request->password,
       ]);

       $tokenRequest = Request::create(
           env('APP_URL') . '/oauth/token',
           'post'
       );

       $response = Route::dispatch($tokenRequest);

       return $response;

    }

}
