<?php

namespace App\Models;

use App\Traits\helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use SoftDeletes;
    use helper;

    
    protected $table = 'roles';

    public $guarded = [];

    //relations
    public function Activity_logs()
    {
        return $this->morphMany(Activity_log::class, 'causer');
    }

    public function getCreatedAtAttribute(){
        return $this->date_format($this->attributes['created_at']);
    }
}
