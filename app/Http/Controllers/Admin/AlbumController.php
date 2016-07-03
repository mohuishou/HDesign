<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/1 0001
 * Time: 17:20
 */
namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 图册
 * Class AlbumController
 * @package App\Http\Controllers\Admin
 */
class AlbumController extends Controller{

    public function index(Request $request){
        $albums=Album::where('cid',$request->cid)->get();
        $data=[
            'cid'=>$request->cid,
            'title'=>$request->title.'下的图集',
            'albums'=>$albums
        ];
        return view('album.lists',$data);
    }

    public function add(Request $request){
        $this->validate($request, [
            'en_title' => 'required|max:50|not_in:album',
            'cn_title'=>'required|max:50',
            'description'=>'required|max:255',
            'cid' => 'required|numeric',
        ]);

        $album=Album::create($request->all());
        $album->save();

        return [
            'status'=>200,
            'msg'=>'添加成功'
        ];
    }

    public function update(Request $request){
        $this->validate($request, [
            'en_title' => 'required|max:50',
            'cn_title'=>'required|max:50',
            'cid' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        $album=Album::find($request->id);
        $album->cn_title=$request->cn_title;
        $album->en_title=$request->en_title;
        $album->description=$request->description;
        $album->cid=$request->cid;
        if($album->save()){
            return [
                'status'=>200,
                'msg'=>'更新成功'
            ];
        }else{
            return [
                'status'=>20005,
                'msg'=>'更新失败'
            ];
        }
    }

    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        $id=$request->id;


        $album=Album::find($id)->pictures()->first();

        if(!empty($album->id))
            return [
                'status'=>20005,
                'msg'=>'删除错误，在该图集下存在图片！'
            ];

        if(Album::find($id)->delete()){
            return [
                'status'=>200,
                'msg'=>'删除成功'
            ];
        }
    }

    public function cover(Request $request){
        $album=Album::find($request->aid);
        $album->cover=$request->pid;
        if($album->save()){
            return [
                'status'=>200,
                'msg'=>'设置成功'
            ];
        }
    }

    public function getAlbum(Request $request){
        $albums=Album::where('cid',$request->cid)->get();
        return [
            'status'=>200,
            'albums'=>$albums
        ];
    }





}