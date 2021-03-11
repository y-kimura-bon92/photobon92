<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeUploadImage;

class SeUploadImageController extends Controller
{
    //
    // 画像一覧を表示
    public function SeGetList(Request $request) {
        // 入力されたキーワードを取得
        $keyword_image_names = $request->keyword_image_name;
        
        if(!empty($keyword_image_names)) {
            $query = SeUploadImage::query();
            $images = $query->where('image_category', 'like', '%'.$keyword_image_names.'%')->paginate(15);
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        } else {
            // 15件づつページネートを表示する
            $images = SeUploadImage::paginate(15);
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりませんでした。";
        }

        return view("se_upload_image.image_list", ['images' => $images, 'message' => $message]);
    }
}
