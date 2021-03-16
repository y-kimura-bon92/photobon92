<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Http\Requests\UploadImageRequest;

class AdminController extends Controller
{
    //画像アップロード画面の表示
    public function getForm_92() {
        return view('admin.admin_upload_form');
    }



    // 画像をアップロード
    public function postUpload_92(Request $request) {

        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg,jpg'
        ]);
        
        $upload_image = $request->file('image');
    
        if($upload_image) {
            //アップロードされた画像をtempディレクトリに保存する
            $path = $upload_image->store('temp',"public");
            //画像の保存に成功したらDBに記録する
            if($path){
                UploadImage::create([
                    'file_name' => $upload_image->getClientOriginalName(),
                    'file_path' => $path,
                    'image_name' => $request->input('image_name'),
                    'image_category' => $request->input('image_category'),
                ]);
            }
        }
        
        \Session::flash('err_msg', '画像の保存に成功しました。');

        return redirect(route('getForm_92'));
    }



    // 管理画面 画像一覧画面
    public function getList_92(Request $request) {
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

        return view("admin.admin_image_list", ['images' => $images, 'message' => $message, 'keywords' => $keywords]);
    }



    //画像アップデート画面の表示
    public function getDetails_92($id) {
        // モデルからidを取得する
        $image_id = UploadImage::find($id);

        return view('admin.admin_details', ['image_id' => $image_id]);
    }



    // 画像をアップデート
    public function postUpdate_92(Request $request) {
        

        // inputデータを取得
        $inputs = $request->all();

        // 送られてきたIDを照合
        $update_image = UploadImage::find($inputs['image_id']);
        $update_image->fill([
            'image_name'     => $inputs['image_name'],
            'image_category' => $inputs['image_category'],
            'file_name'      => $inputs['file_name'],
        ]);

        $update_image->save();
        \Session::flash('err_msg', '画像データを更新しました');

        return redirect(route('getList_92'));
    }



    //削除処理
    public function postDelete_92($id) {
        // データを削除
        UploadImage::destroy($id);

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('getList_92'));
    }
}
