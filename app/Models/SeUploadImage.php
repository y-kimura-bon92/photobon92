<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeUploadImage extends Model
{
    //
    protected $table = "seuploadimage";
    protected $fillable = [
        'file_name',
        'file_path',
        'image_name',
        'image_category',
    ];
}
