<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait Upload
{
    // $width => if i pass don't pass width image uploaded with fullsize
    public static function uploadImage($image, $path, $width = NULL){
        try {
            //Change Name
            $imageName = rand(0,1000000) . time() . '.' . $image->getClientOriginalExtension();

            //upload full size
            if(!$width)
                $image->move(public_path($path), $imageName);

            //upload width new size
            if($width){
                $image_resize = Image::make($image->getRealPath());

                //get new size
                $new_width = $image_resize->width();
                $new_height = $image_resize->height();

                if($width < $image_resize->width()){
                    $original_width_origin = ($width / $image_resize->width()) * 100;
                    $new_height = ($image_resize->height() / 100) * $original_width_origin;
                    $new_width = $width;
                }
                
                $image_resize->resize($new_width, $new_height)
                            ->save(public_path($path . '/' . $imageName));
            }

            return $imageName;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function uploadFile($file, $path){
        $name = rand(0,1000000) . time() . '.' . $file->getClientOriginalExtension();

        // $file->move(base_path( $path . '/'), $name);
        $file->move(base_path('public/' . $path . '/'), $name);

        return $name;
    }
}