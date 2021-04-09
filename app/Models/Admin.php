<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photos()
    {
        return $this->hasMany(AdminPhotoProfile::class);
    }

    public function storeImage()
    {
        $imagesInfo = $this->getInfoImageFromSession();

        if ($imagesInfo) {
            foreach ($imagesInfo as $imageInfo) {
                $this->photos()->create([
                    'path' => $imageInfo['path'],
                    'hash' => $imageInfo['hash'],
                ]);
            }
        }
    }

    protected function getInfoImageFromSession() : array
    {
        return request()->session()->pull('images_info', []); 
    }
}
