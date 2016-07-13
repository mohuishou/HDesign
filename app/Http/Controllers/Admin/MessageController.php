<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/11 0011
 * Time: 1:49
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller{

    public function index(Request $request){
        $msg=Message::all();
        $data=[
            'title'=>'留言管理',
            'message'=>$msg,
            'avatar'=>$request->user()->avatar
        ];

        return view('admin.message',$data);

    }

    /**
     * 新增留言
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'tel'=>'required|max:11',
            'email'=>'required|email',
            'comment'=>'required|max:1000',
        ]);

        $msg=Message::create($request->all());
        $msg->save();

        return [
            'status'=>200,
            'msg'=>'添加成功'
        ];
    }

    /**
     * 更新留言
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'id' => 'required',
            'tel'=>'required|max:11',
            'email'=>'required|email',
            'comment'=>'required|max:1000',
        ]);

        $msg=Message::find($request->id);
        $msg->name=$request->name;
        $msg->email=$request->email;
        $msg->tel=$request->tel;
        $msg->comment=$request->comment;
        if($msg->save()){
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

    /**
     * 删除留言
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required',

        ]);

        $msg=new Message();

        $re=$msg->find($request->id)->delete();
        if($re){
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