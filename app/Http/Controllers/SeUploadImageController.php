<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeUploadImage;

class SeUploadImageController extends Controller
{
    //
    // 画像一覧を表示
    public function SeGetList() {
        //アップロードした画像を取得
        // $uploads = SeUploadImage::orderBy("id", "desc")->get();

        // これでページネーション機能が追加される
        $uploads = SeUploadImage::paginate(15);

        return view("se_upload_image.image_list", ['images' => $uploads]);
    }



    // 検索結果
    public function SeGetSearch(Request $request) {
        // $pagenate = SeUploadImage::paginate(10);

        $keyword_image_names = $request->keyword_image_name;
        
        if(!empty($keyword_image_names)) {
            $query = SeUploadImage::query();
            $images = $query->where('image_category', 'like', '%' .$keyword_image_names. '%')->get();
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        }
        
        return view('se_search_image.search', ['images' => $images, 'message' => $message]);
    }


    public function SeGetSearch_92(Request $request) {
        $keyword_image_names = $request->keyword_image_name;
        
        if(!empty($keyword_image_names)) {
            $query = SeUploadImage::query();
            $images = $query->where('image_category', 'like', '%' .$keyword_image_names. '%')->get();
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        }
        
        return view('se_admin.admin_search', ['images' => $images, 'message' => $message]);
    }
}
