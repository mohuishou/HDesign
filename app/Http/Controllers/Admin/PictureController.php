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
        $album=Album::find($request->aid);
        $pictures=$album->pictures;
        $data=[
            'aid'=>$request->aid,
            'cover'=>$album->cover,
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
            $album=Album::find($request->aid);
            if($album->cover==0){
                $album->cover=$album_pic->picture_id;
                $album->save();
            }

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
        $this->validate($request, [
            'aid' => 'required',
            'pid' => 'required'
        ]);

        $album=Album::find($request->aid);
        $pictures=Album::find($request->aid)->pictures;
        if($album->cover==$request->pid){
            if(count($pictures)!=1){
                return [
                    'status'=>20008,
                    'msg'=>'该图片为封面图片，封面图片只允许最后删除，请先设置其他图片为封面'
                ];
            }else{
                $album->cover=0;
                $album->save();
            }
        }


        $picture=$pictures->find($request->pid)->delete();
        if($picture){
            return [
                'status'=>200,
                'msg'=>'删除成功'
            ];
        }else{
            return [
                'status'=>20007,
                'msg'=>'删除失败，数据库错误'
            ];
        }
    }





}