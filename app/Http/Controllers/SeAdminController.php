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
            'image' => 'required|file|image|mimes:png,jpeg,jpg',
            'image_th' => 'required|file|image|mimes:png,jpeg,jpg'
        ]);
        
        // 選択された画像を取得
        $upload_image    = $request->file('image');
        $upload_image_th = $request->file('image_th');

        if($upload_image && $upload_image_th) {
            //アップロードされた画像をtempディレクトリに保存する
            $path    = $upload_image->store('setemp',"public");
            $path_th = $upload_image_th->store('setemp_th',"public");

            //画像の保存に成功したらDBに記録する
            if($path){
                SeUploadImage::create([
                    'file_name'      => $upload_image->getClientOriginalName(),
                    'file_name_th'   => $upload_image_th->getClientOriginalName(),
                    'file_path'      => $path,
                    'file_path_th'   => $path_th,
                    'image_name'     => $request->input('image_name'),
                    'image_category' => $request->input('image_category'),
                ]);
            }
        }
        
        \Session::flash('err_msg', '画像の保存に成功しました。');

        // 画像投稿フォームへリダイレクト
        return redirect(route('SeGetForm_92'));
    }



    // 管理画面 画像一覧画面
    public function SeGetList_92(Request $request) {
        // 入力されたキーワードを取得
        $keywords = $request->input('keyword_image_name');

        // キーワードの入力が確認できた場合
        if(!empty($keywords)) {
            $query = SeUploadImage::query();

            // 一致する画像名、カテゴリをDBから取得
            foreach ((array)$keywords as $keyword) {
                $images = $query->where('image_category','like','%'.$keyword.'%')->orWhere('image_name', 'LIKE', '%'.$keyword.'%')->orderBy('created_at','desc')->paginate(36);
            }

            // 表示件数のカウント数を取得
            $count = $query->where('image_category','like','%'.$keyword.'%')->orWhere('image_name', 'LIKE', '%'.$keyword.'%')->orderBy('created_at','desc')->count();
            $message = "「".$keywords."」を含む検索結果が（".$count."）件見つかりました。";
        } else {
            // 36件づつページネートを表示する
            $images = SeUploadImage::orderBy('created_at','desc')->paginate(36);
            $count = SeUploadImage::count();
            $message = "検索結果が見つかりませんでした。 「全画像数（".$count."件）」";
        }

        return view("se_admin.admin_image_list", ['images' => $images, 'message' => $message, 'keywords' => $keywords, 'image_size' => $image_size]);
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

        // ダウンロード画像が更新された場合
        if(isset($inputs['image'])) {
            // 画像を取得
            $upload_image = $request->file('image');
            //アップロードされた画像をtempディレクトリに保存する
            $path    = $upload_image->store('setemp',"public");

            // 送られてきたIDを照合
            $update_image = SeUploadImage::find($inputs['image_id']);
            // データをアップデート
            $update_image->fill([
                'file_name'      => $inputs['image']->getClientOriginalName(),
                'file_path'      => $path,
                'image_name'     => $inputs['image_name'],
                'image_category' => $inputs['image_category'],
            ]);

        } elseif(isset($inputs['image_th'])) {// サムネイル画像が更新された場合
            // 画像を取得
            $upload_image_th = $request->file('image_th');
            //アップロードされた画像をtempディレクトリに保存する
            $path_th = $upload_image_th->store('setemp_th',"public");

            // 送られてきたIDを照合
            $update_image = SeUploadImage::find($inputs['image_id']);
            // データをアップデート
            $update_image->fill([
                'file_name_th'   => $inputs['image_th']->getClientOriginalName(),
                'file_path_th'   => $path_th,
                'image_name'     => $inputs['image_name'],
                'image_category' => $inputs['image_category'],
            ]);

        } else {
            // 送られてきたIDを照合
            $update_image = SeUploadImage::find($inputs['image_id']);
            // データをアップデート
            $update_image->fill([
                'image_name'     => $inputs['image_name'],
                'image_category' => $inputs['image_category'],
            ]);
        }

        $update_image->save();
        \Session::flash('err_msg', '画像データを更新しました');

        return redirect(route('SeGetDetails', [
            'id' => $inputs['image_id'],
        ]));
    }



    //削除処理
    public function SePostDelete_92($id) {
        // データを削除
        SeUploadImage::destroy($id);

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('SeGetList_92'));
    }
}
