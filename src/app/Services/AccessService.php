<?php

namespace App\Services;

use Auth;
use App\User;

class AccessService
{    
    private $userRoles;

    public function checkRoles()
    {
        if (is_null($this->userRoles)) {
            $this->userRoles = Auth::user()->roles()->pluck('role_name');
        }

        return $this->userRoles;
    }
}
