<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPhotoProfile extends Model
{
    public $timestamps = FALSE;

    protected $fillable = [
        'admin_id',
        'path',
        'hash',
        'deleted'
    ];
}