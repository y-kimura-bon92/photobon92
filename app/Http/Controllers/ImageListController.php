<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class ImageListController extends Controller
{
    //
    public function getList(Request $request) {
        // 入力されたキーワードを取得
        $keyword_image_names = $request->keyword_image_name;
        
        // キーワードの入力が確認できた場合
        if(!empty($keyword_image_names)) {
            $query = UploadImage::query();
            $images = $query->where('image_category', 'like', '%'.$keyword_image_names.'%')->paginate(15);
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりました。";
        } else {
            // 15件づつページネートを表示する
            $images = UploadImage::paginate(15);
            $message = "「".$keyword_image_names."」を含む検索結果が見つかりませんでした。";
        }

        return view("upload_image.image_list", ['images' => $images, 'message' => $message]);
    }
}
