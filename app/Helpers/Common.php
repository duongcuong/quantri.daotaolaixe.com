<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class Common
{
    public static function uploadImage($file, $directory, $resizeWidth = null, $resizeHeight = null)
    {
        $get_imageName  =  date('YmdHis') . uniqid() . $file->getClientOriginalName();
        $directory      = 'images/profiles/';
        $imageUrl       = $directory . $get_imageName;

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        }

        Image::make($file)->resize($resizeWidth, $resizeHeight)->save($imageUrl);
        return $imageUrl;
    }
}
