<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Http\Requests\UploadImageRequest;


class UploadImageController extends Controller
{


    //画像アップロード画面の表示
    public function getForm() {
        return view('upload_image.upload_form');
    }



    // 画像をアップロード
    public function postUpload(Request $request) {

        // $request->input('image_name');
        var_dump($request->input('image_name'));
        exit;
        // $inputs = $request->all();

        // \DB::beginTransaction();
        
            // ブログを登録
            // UploadImage::create($inputs);
            // \DB::commit();
        
        // $inputs = UploadImage::create($request->except(['file_name']));
        
        // $inputs = $request->input('image_name');
        
        // UploadImage::create($inputs);
//----------------------------------------------



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
                ]);
            }
        }
        return redirect(route('getList'));
    }
}
