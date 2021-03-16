<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeUploadImage extends Model
{
    //
    protected $table = "seuploadimage";
    protected $fillable = [
        'file_name',
        'file_name_th',
        'file_path',
        'file_path_th',
        'image_name',
        'image_category',
    ];
}
