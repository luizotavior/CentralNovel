<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageRepository
{
    public function saveImage($image,$size,$destino,$fileName = null)
    {
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->getClientOriginalExtension();
            if($fileName == null){
                $fileName = time() . random_int(100, 999) .'.' . $extension; 
            }else{
                $fileName .= '.' . $extension; 
            }
            $destinationPath = public_path("storage/".$destino);
            $url = $destino.$fileName;

            $fullPath = $destinationPath.$fileName;

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775);
            }

            $image = Image::make($file)
                ->resize($size[0], $size[1]);
            $image->save($fullPath, 75);

            return $url;

        } else {
            return null;
        }
    }
}