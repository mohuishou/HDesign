<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/1 0001
 * Time: 15:39
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Picture;
use Illuminate\Http\Request;

class UploadController extends Controller{

    /**
     * 允许上传的文件类型
     * @var array
     */
    static public $_allow_extensions=["png", "jpg", "gif"];

    /**
     * 单图上传
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    static public function picture(Request $request){
        $allowed_extensions=["png", "jpg", "gif"];
        $file=$request->file('picture');
        if(!empty($file)){
            /*---------检查扩展名-----------*/
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return [
                    'status'=>0,
                    'msg'=>'仅允许上传，jpg,png,gif文件'
                ];
            }
            $fileName= $file->getClientOriginalName();
            $file_extensions=$file->getClientOriginalExtension();
            $safeName=md5($fileName).'.'.$file_extensions;
            $folderName = 'uploads/images/' . date("Ym", time()) .'/'.date("d", time());
            $destinationPath = $folderName;
            $file->move($destinationPath, $safeName);
            $file_path=$destinationPath.'/'.$safeName;

            /*--------------入库---------------*/
            $pic=Picture::firstOrCreate(['path'=>$file_path]);
            $pic->save();
            return [
                'status'=>200,
                'path'=>asset($pic->path),
                'pid'=>$pic->id,
            ];
        }
        return [
            'status'=>0,
            'msg'=>'上传文件错误'
        ];

    }

    /**
     * 多图上传
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    static public function pictures(Request $request){
        $allowed_extensions=["png", "jpg", "gif"];
        $files=$request->file('pictures');


        foreach ($files as $file) {
            if(!empty($file)){
                /*---------检查扩展名-----------*/
                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    return [
                        'status'=>0,
                        'msg'=>'仅允许上传，jpg,png,gif文件'
                    ];
                }

                $fileName= $file->getClientOriginalName();
                $file_extensions=$file->getClientOriginalExtension();
                $safeName=md5($fileName).'.'.$file_extensions;
                $folderName = 'uploads/images/' . date("Ym", time()) .'/'.date("d", time());
                $destinationPath = $folderName;
                $file->move($destinationPath, $safeName);
                $file_path=$destinationPath.'/'.$safeName;

                /*--------------入库---------------*/
                $pic=Picture::firstOrCreate(['path'=>$file_path]);
                $pic->save();

                return [
                    'status'=>200,
                    'path'=>asset($pic->path),
                    'pid'=>$pic->id,
                ];
            }else {
                return [
                    'status'=>0,
                    'msg'=>'上传文件错误'
                ];
                break;
            }
        }

    }



}
