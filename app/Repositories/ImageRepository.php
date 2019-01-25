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

            $image = Image::make($file)
                ->resize($size[0], $size[1]);

            $resource = $image->stream()->detach();

            $disk = \Storage::disk('gcs');
            $image = Image::make($image)
                ->resize($size[0], $size[1]);
            $disk->put($destino.$fileName, $image->getEncoded());
            return $destino.$fileName;
        } else {
            return null;
        }
    }
}