<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class ImageListController extends Controller
{
    //画像一覧画面
    public function getList(Request $request) {
        // 入力されたキーワードを取得
        $keywords = $request->input('keyword_image_name');
        
        // キーワードの入力が確認できた場合
        if(!empty($keywords)) {
            $query = UploadImage::query();

            // 一致する画像名、カテゴリをDBから取得
            foreach ((array)$keywords as $keyword) {
                $images = $query->where('image_category','like','%'.$keyword.'%')->orWhere('image_name', 'LIKE', '%'.$keyword.'%')->orderBy('created_at','desc')->paginate(36);
            }

            // 表示件数のカウント数を取得
            $count = $query->where('image_category','like','%'.$keyword.'%')->orWhere('image_name', 'LIKE', '%'.$keyword.'%')->orderBy('created_at','desc')->count();
            $message = "「".$keywords."」を含む検索結果が（".$count."）件見つかりました。";
        } else {
            // 36件づつページネートを表示する
            $images = UploadImage::orderBy('created_at','desc')->paginate(36);
            $count = UploadImage::count();
            $message = "検索結果が見つかりませんでした。 「全画像数（".$count."件）」";
        }

        return view("upload_image.image_list", ['images' => $images, 'message' => $message, 'keywords' => $keywords]);
    }
}
