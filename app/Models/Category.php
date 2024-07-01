<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;
    use HasRecursiveRelationships;
    protected $table = 'categories';
    public $translatedAttributes = ['name'];
    protected $guarded = [];

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function getLocalKeyName()
    {
        return 'id';
    }

    public function getPath(){
        $cats = $this->ancestors()->orderBy('depth', 'ASC')->get();
        $path = '';
        foreach($cats as $cat){
            $path .= '/' . $cat->translate(LaravelLocalization::getCurrentLocale())->name;
        }

        return $path;
    }
}
