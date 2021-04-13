<?php

namespace App\Services\Admin;

use Illuminate\Http\UploadedFile;
use Storage;

class HandleImage
{
    public function storeImages(string $disk, string $directory, $images)
    {
        if (! is_array($images)) {
            $images = [$images];
        }

        $allInfo = [];
        foreach ($images as $image) {
            $filename = time() . $image->getClientOriginalName();
            $path = Storage::disk($disk)->putFileAs($directory, $image, $filename);
            $hash = md5_file(\storage_path('app/admin/' . $path));
            $allInfo[] = [
                'path' => $path,
                'hash' => $hash,
            ];
        }
        
        return $allInfo;
    }

    public function getImage(string $path)
    {
        if ( ! Storage::disk('admin')->exists($path)) {
            abort('404');
        }
        $path = Storage::disk('admin')->path($path);

        return $path;
    }

    public function removeImages(array $paths)
    {
        $removed = [];
        if (count($paths) > 0) {
            $removedId = [];
            foreach($paths as $key => $path) {
                Storage::disk('admin')->delete($path)
                ? array_push($removedId, $key)
                : '';
            }
            $removed[] = $removedId;
        }
        return $removed;
    }

    protected function toSession(array $data)
    {
        session($data);
    }
}