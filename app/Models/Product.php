<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    ###### Start  Relations ########

    public function Sizes() {
        return $this->belongsToMany(Size::class,'product_sizes' ,'product_id','size_id');
    }

    ###### End Relations ########

}

