<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function LogOut()
    {
        Auth::logout();

        return Redirect()->route('login')->with('success', 'Log Out Successfully');
    }

}


