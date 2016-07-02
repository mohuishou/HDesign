<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/1 0001
 * Time: 12:20
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\System;
use Illuminate\Http\Request;

class SystemController extends Controller{

    public function index(){
        $data=['title'=>'系统设置'];
        return view('admin.system',$data);
    }

    public function update(Request $request){
        $val=[
            'name'=>$request->action,

        ];
        $s=System::firstOrCreate($val);
        $s->value=$request->value;
        $s->save();
        return [
            'status'=>200,
            'msg'=>'更新成功'
        ];
    }

    public function logo(Request $request){
        $res=UploadController::picture($request);

        if($res['status']==200){
            $val=[
                'name'=>'web_logo',
                'value'=>$res['path']
            ];
            $s=System::firstOrCreate($val);
            $s->save();
        }

        return $res;
    }




}