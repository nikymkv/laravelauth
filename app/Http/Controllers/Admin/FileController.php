<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminPhotoProfile;
use App\Models\AdminHasPhoto;
use App\Services\Admin\HandleImage;
use Storage;

class FileController extends Controller
{
    protected $handleImage;

    public function __construct(HandleImage $handleImage)
    {
        $this->handleImage = $handleImage;
    }

    public function storeImages(Request $request)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesInfo = $this->handleImage->storeImages('admin', 'images', $images);

            AdminPhotoProfile::storeAndAttach(
                $imagesInfo,
                $request->get('admin_id')
            );

            $response = [
                'success' => 1,
                'msg' => 'Files were saved',
                'result' => $imagesInfo,
            ];
        } else {
            $response = [
                'success' => 0,
                'error_msg' => 'Files array are empty!',
            ];
        }

        return response()->json($response);
    }

    public function removeImages(Request $request)
    {
        $paths = AdminPhotoProfile::whereIn(
                'id',
                $request->get('removeImages')
            )
            ->pluck('path', 'id')
            ->toArray();
        $removed = $this->handleImage->removeImages($paths);
        AdminPhotoProfile::destroy($removed);
        
        return response()->json([
            'success' => 1,
        ]);
    }

    public function getProfileImage(AdminPhotoProfile $photo)
    {
        $path = isset($photo) ? $photo->path : null;

        return response()->file($this->handleImage->getImage($path));
    }
}
