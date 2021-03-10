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



    // 画像一覧画面
    public function getList_92() {
        //アップロードした画像を取得
        // $uploads = UploadImage::orderBy("id", "desc")->get();

        // これでページネーション機能が追加される
        $uploads = UploadImage::paginate(15);

        // viewを表示 管理画面画像一覧
        return view('admin.admin_image_list', ['images' => $uploads]);
    }



    //画像アップロード画面の表示
    public function getDetails_92($id) {
        // モデルからidを取得する
        $image_id = UploadImage::find($id);

        return view('admin.admin_details', ['image_id' => $image_id]);
    }



    // 画像をアップロード
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



    public function postDelete_92($id) {
        // データを削除
        UploadImage::destroy($id);

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('getList_92'));
    }
}
