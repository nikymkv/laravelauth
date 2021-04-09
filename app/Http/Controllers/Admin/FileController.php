<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminPhotoProfile;
use App\Services\Admin\HandleImage;
use Storage;

class FileController extends Controller
{
    public function storeImage(Request $request, Admin $admin, HandleImage $handleImage)
    {
        if ($request->hasFile('images')) {

            $images = $request->file('images');
            $handleImage->storeImages(
                is_array($images)
                ? $images
                : [$images]
            );

            $response = [
                'success' => 1,
                'msg' => 'Files were saved',
            ];
        } else {
            $response = [
                'success' => 0,
                'error_msg' => 'Files array are empty!',
            ];
        }

        return response()->json($response);
    }

    public function getProfileImage(AdminPhotoProfile $photo)
    {
        $path = isset($photo) ? $photo->path : null;
        if ( ! Storage::disk('admin')->exists($path)) {
            abort('404');
        }

        return response()->file(\storage_path('app/admin/' . $path));
    }
}
