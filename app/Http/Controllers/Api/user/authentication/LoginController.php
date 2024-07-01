<?php

namespace App\Http\Controllers\Api\user\authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\user\loginRequest;
use App\Http\Resources\userResource;
use App\Traits\response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(loginRequest $request){
        $credentials = ['username' => $request->username, 'password' => $request->password];
        
        if (! $token = auth('user_api')->attempt($credentials))
            return $this->failed(trans('api.passwored or username is wrong'), 404, 'E04');

        $response = [
            'user'  => new userResource(auth('user_api')->user()),
            'token' => $token,
        ];

        return $this->success(trans('api.success'),
                200,
                'data',
                $response
        );
    }

    public function logout(){
        auth('user_api')->logout();

        return response::success(trans('auth.success'));
    }
}
