<?php

namespace App\Models;

use App\Traits\helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use helper;
    
    protected $table = 'users';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    //relations
    public function Image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function Activity_logs()
    {
        return $this->morphMany(Activity_log::class, 'causer');
    }

    //
    public function getImage(){
        if($this->Image != null){
            return url('uploads/users/' . $this->Image->src);
        } else {
            return url('uploads/users/default.jpg');
        }
    }

    public function getRole(){
        if(count($this->roles) > 0){
            return $this->roles[0]->name;
        } else {
            return null;
        }
    }

    public function getRoleId(){
        if(count($this->roles) > 0){
            return $this->roles[0]->id;
        } else {
            return null;
        }
    }

    public function getCreatedAtAttribute(){
        return $this->date_format($this->attributes['created_at']);
    }

    public function has_permission($permission){
        if($this->super == 1)
            return true;
        
        if($this->isAbleTo($permission))
            return true;

        return false;
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'type'       => 'user_api'
        ];
    }
}
