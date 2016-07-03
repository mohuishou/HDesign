<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/3 0003
 * Time: 15:36
 */
namespace App\Http\Controllers\Admin;

use App\Album;
use App\AlbumPicture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PictureController extends Controller{

    public function index(Request $request){
        $pictures=Album::find($request->aid)->pictures;
        $data=[
            'aid'=>$request->aid,
            'title'=>$request->title.'下的图片',
            'pictures'=>$pictures
        ];
        return view('album.picture',$data);
    }

    public function add(Request $request){
        $pic=UploadController::pictures($request);

        if($pic['status']!=200)
            return $pic;

        $album_pic=new AlbumPicture();
        $album_pic->album_id=$request->aid;
        $album_pic->picture_id=$pic['pid'];
        if($album_pic->save()){
            return [
                'status'=>200,
                'path'=>$pic['path'],
                'msg'=>'上传成功'
            ];
        }else{
            return [
                'status'=>20006,
                'msg'=>'上传失败'
            ];
        }


    }


    public function destroy(Request $request){
        $pictures=Album::find($request->aid)->pictures()->find($request->pid)->delete();
        if($pictures){
            return [
                'status'=>200,
                'msg'=>'删除成功'
            ];
        }else{
            return [
                'status'=>20007,
                'msg'=>'删除失败'
            ];
        }
    }





}