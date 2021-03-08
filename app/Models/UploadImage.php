<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    //
    protected $table = "uploadimage";
    protected $fillable = [
        'file_name',
        'file_path',
        'image_name',
    ];
}
