<?php

namespace App\Http\Controllers\Api\user\authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\user\changeImageRequest;
use App\Http\Requests\Api\user\changePasswordRequest;
use App\Http\Requests\Api\user\updateRequest;
use App\Http\Resources\userResource;
use App\Models\Image;
use App\Traits\response;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    use Upload;
    public function show(){
        $user = auth('user_api')->user();

        return $this->success(
            trans('auth.success'),
            200,
            'data',
            new userResource($user)
        );
    }

    public function update(updateRequest $request){
        $user = auth('user_api')->user();

        $filterRequest = $request->only(
            'username','name'
        );

        $user->update($filterRequest);

        return $this->success(trans('auth.success'),
                                200,
                                'data',
                                new userResource($user)
                            );
    }

    public function changePassword(changePasswordRequest $request){
        $user = auth('user_api')->user();

        //update user pass
        if(Hash::check($request->old_password, $user->password)){
            $user->password  = Hash::make($request->password);
            $user->save();
        } else {
            return $this->failed(trans('api.old password is wrong'), 400);
        }

        return $this->success(trans('auth.success'), 200);
    }

    public function changeImage(changeImageRequest $request){
        $user = auth('user_api')->user();

        $path = $this->uploadImage($request->file('image'), 'uploads/users', 300);

        if($user->Image == null){ //if not has image
            Image::create([
                'imageable_id'   => $user->id,
                'imageable_type' => 'App\Models\User',
                'src'            => $path,
            ]);
        } else { //if has image
            $oldImage = $user->Image->src;
            if(file_exists(base_path('public/uploads/users/') . $oldImage)){
                unlink(base_path('public/uploads/users/') . $oldImage);
            }

            $user->Image->src = $path;
            $user->Image->save();
        }

        return $this->success(trans('auth.success'), 200);
    }
}
