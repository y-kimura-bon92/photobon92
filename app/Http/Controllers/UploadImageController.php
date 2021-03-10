<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Http\Requests\UploadImageRequest;


class UploadImageController extends Controller
{

    // 検索結果
    public function getSearch(Request $request) {
        $keyword_image_names = $request->keyword_image_name;
        
        if(!empty($keyword_image_names)) {
            $query = UploadImage::query();
            $images = $query->where('image_category', 'like', '%' .$keyword_image_names. '%')->get();
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        }

        $pagenate = $query->paginate(10);

        return view('search_image.search', ['images' => $images, 'message' => $message, 'pagenate' => $pagenate]);
    }

    public function getSearch_92(Request $request) {
        $keyword_image_names = $request->keyword_image_name;
        
        if(!empty($keyword_image_names)) {
            $query = UploadImage::query();
            $images = $query->where('image_category', 'like', '%' .$keyword_image_names. '%')->get();
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        }

        
        return view('admin.admin_search', ['images' => $images, 'message' => $message]);
    }
}
