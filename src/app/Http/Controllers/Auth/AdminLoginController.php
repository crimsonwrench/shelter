<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/panel';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function username()
    {
        return 'name';
    }

}
