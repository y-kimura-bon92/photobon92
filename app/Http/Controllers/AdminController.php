<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Http\Requests\UploadImageRequest;

class AdminController extends Controller
{

    // 画像一覧画面
    public function getList_92() {
        //アップロードした画像を取得
        $uploads = UploadImage::orderBy("id", "desc")->get();

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

        $update_image = UploadImage::find($inputs['image_id']);
        $update_image->fill([
            'image_name' => $inputs['image_name'],
            'file_name' => $inputs['file_name'],
        ]);

        $update_image->save();
        \Session::flash('err_msg', '画像データを更新しました');

        return redirect(route('getList_92'));
    }
}
