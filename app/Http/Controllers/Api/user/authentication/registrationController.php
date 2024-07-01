<?php

namespace App\Http\Controllers\Api\user\authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\user\createRequest;
use App\Models\User;
use App\Traits\response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class registrationController extends Controller
{
    public function register(createRequest $request){
        $user = User::create([
            'username'          => $request->username,
            'name'              => $request->name,
            'password'          => Hash::make($request->password),
        ]);

        //create token
        $token = JWTAuth::fromUser($user);

        $data = [
            'user'  => $user,
            'token' => $token,
        ];

        return $this->success(trans('api.success'),
                                200,
                                'data',
                                $data);
    }
}
