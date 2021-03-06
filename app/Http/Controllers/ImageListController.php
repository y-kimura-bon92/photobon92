<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class ImageListController extends Controller
{
    //
    public function getList() {
        //アップロードした画像を取得
        $uploads = UploadImage::orderBy("id", "desc")->get();


        return view("upload_image.image_list", ['images' => $uploads]);
    }
}
