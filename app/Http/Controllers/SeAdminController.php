<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeUploadImage;

class SeAdminController extends Controller
{
    //
    //画像アップロード画面の表示
    public function SeGetForm_92() {
        return view('se_admin.admin_upload_form');
    }



    // 画像をアップロード
    public function SePostUpload_92(Request $request) {

        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg,jpg'
        ]);
        
        $upload_image = $request->file('image');
    
        if($upload_image) {
            //アップロードされた画像をtempディレクトリに保存する
            $path = $upload_image->store('setemp',"public");
            //画像の保存に成功したらDBに記録する
            if($path){
                SeUploadImage::create([
                    'file_name' => $upload_image->getClientOriginalName(),
                    'file_path' => $path,
                    'image_name' => $request->input('image_name'),
                    'image_category' => $request->input('image_category'),
                ]);
            }
        }
        
        \Session::flash('err_msg', '画像の保存に成功しました。');

        // 画像投稿フォームへリダイレクト
        return redirect(route('SeGetForm_92'));
    }



    // 管理画面画 像一覧画面
    public function SeGetList_92() {
        //アップロードした画像を取得
        $uploads = SeUploadImage::orderBy("id", "desc")->get();

        // viewを表示 管理画面画像一覧
        return view('se_admin.admin_image_list', ['images' => $uploads]);
    }



    //画像アップデート画面の表示
    public function SeGetDetails_92($id) {
        // モデルからidを取得する
        $image_id = SeUploadImage::find($id);

        return view('se_admin.admin_details', ['image_id' => $image_id]);
    }



    // 画像をアップデート
    public function SePostUpdate_92(Request $request) {
        
        // inputデータを取得
        $inputs = $request->all();

        // 送られてきたIDを照合
        $update_image = SeUploadImage::find($inputs['image_id']);
        $update_image->fill([
            'image_name'     => $inputs['image_name'],
            'image_category' => $inputs['image_category'],
            'file_name'      => $inputs['file_name'],
        ]);

        $update_image->save();
        \Session::flash('err_msg', '画像データを更新しました');

        return redirect(route('SeGetList_92'));
    }



    public function SePostDelete_92($id) {
        // データを削除
        SeUploadImage::destroy($id);

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('SeGetList_92'));
    }
}
