<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function loginView(){
        return view('dashboard.login');
    }

    public function login(login $Request){
        $credentials = ['username' => $Request->username, 'password' => $Request->password];

        if (Auth::guard('user')->attempt($credentials))
            return redirect()->intended('dashboard/login');

        return redirect(route('dashboard.home'))->with('error', trans('admin.username or password is wrong'));
    }
    
    public function logout(){
        
        Auth::guard('user')->logout();

        return redirect(route('dashboard.adminlogin'));
    }
}
