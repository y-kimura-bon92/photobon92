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
        dd($uploads);

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
        // $request->validate([
        //     'image' => 'required|file|image|mimes:png,jpeg,jpg'
        // ]);
        $upload_image = $request->file('image');
        $inputs = $request->all();

        $image_id = UploadImage::find($inputs['image_id']);

        // $image_id->fill([
        //     'image_name' => $inputs['image_name'],
        //     'file_name' => $inputs['file_name'],
        // ]);
        

        UploadImage::where('id', $image_id)->update([
            'image_name' => $inputs['image_name'],
        ]);

        // 画像名を取得、保存
        // $inputs->save();
        

        if($upload_image) {
            //アップロードされた画像を保存する
            $path = $upload_image->store('temp',"public");
            //画像の保存に成功したらDBに記録する
            if($path){
                UploadImage::update([
                    "file_name" => $upload_image->getClientOriginalName(),
                    "file_path" => $path
                ]);
            }
        }

        return redirect(route('getList_92'));
    }
}
