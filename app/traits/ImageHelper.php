<?php

namespace App\traits;

use Illuminate\Support\Str;

trait ImageHelper
{

    public function storeImage($folder, $imageRequest)
    {
        $extension = $imageRequest->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $imageRequest->move('assets/images/' . $folder, $filename);
        return $filename;
    }

    public function storeMultipleImage($folder, $imagesRequest)
    {
        $images_name = '';
        foreach ($imagesRequest as $key => $img) {
            $extension = $img->getClientOriginalExtension();
            $filename = time() . $key . '.' . $extension;
            $img->move('assets/images/' . $folder, $filename);
            $images_name = $images_name . ',' . $filename;
        }
        return $images_name;
    }

    public function deleteImage($folder, $oldImage)
    {
        // folder exist in "public/assets/images"
        $image = Str::after($oldImage, $folder . '/');
        $image = base_path('public\assets\images\\' . $folder . '\\' . $image);
        unlink($image);
    }

}
