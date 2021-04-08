<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use Storage;

class FileController extends Controller
{
    public function storeProfileImage(Request $request, Admin $admin)
    {
        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');
            $filename = time() . $photo->getClientOriginalName();
            $pathPhoto = Storage::disk('admin')->putFileAs('photoProfile', $photo, $filename);
            $hashPhoto = md5_file(\storage_path('app/admin/' . $pathPhoto));

            $request->session()->put('profile_photo_path', $pathPhoto);
            $request->session()->put('profile_photo_hash', $hashPhoto);

            $response = [
                'success' => 1
            ];
        } else {
            $response = [
                'success' => 0
            ];
        }

        return \response()->json($response);


    }

    public function getProfileImage(Admin $admin)
    {
        $path = isset($admin->photo->path) ? $admin->photo->path : null;
        if ( ! Storage::disk('admin')->exists($path)) {
            abort('404');
        }

        return response()->file(\storage_path('app/admin/' . $path));
    }
}
