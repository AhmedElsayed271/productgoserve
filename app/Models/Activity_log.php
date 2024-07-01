<?php

namespace App\Models;

use App\Traits\helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_log extends Model
{
    use HasFactory;
    use helper;
    protected $table = 'activity_log';

    public $guarded = [];

    protected $casts = [
        'id'            => 'integer',
        'properties'    => 'array',
    ];

    //relations
    public function subject()
    {
        return $this->morphTo();
    }

    public function causer()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute(){
        return $this->date_format($this->attributes['created_at']);
    }
}
