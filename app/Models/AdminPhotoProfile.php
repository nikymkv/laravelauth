<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPhotoProfile extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'path',
        'hash',
    ];

    public static function storeAndAttach(array $imagesInfo, int $adminId)
    {
        AdminPhotoProfile::insert($imagesInfo);
        $imagesId = AdminPhotoProfile::whereIn(
                                'path', array_column($imagesInfo, 'path')
                            )
                            ->pluck('id')
                            ->toArray();

        $admin = Admin::find($adminId);
        $admin->photos()->attach($imagesId);
    } 
}