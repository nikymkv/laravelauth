<?php

namespace App\Services\Admin;

use Illuminate\Http\UploadedFile;
use Storage;

class HandleImage
{
    public function storeImages(array $images)
    {
        $allInfo = [];
        foreach ($images as $image) {
            $filename = time() . $image->getClientOriginalName();
            $path = Storage::disk('admin')->putFileAs('image', $image, $filename);
            $hash = md5_file(\storage_path('app/admin/' . $path));
            $allInfo[] = [
                'path' => $path,
                'hash' => $hash,
            ];
        }

        session([
            'images_info' => $allInfo,
        ]);
    }
}