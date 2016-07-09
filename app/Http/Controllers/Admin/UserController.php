<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/6/30 0030
 * Time: 17:24
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    /**
     * 登录
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    function login(Request $request){
//
        $this->validate($request, [
            'username' => 'required|max:20',
            'password' => 'required',
        ]);

        if($request->has('backUrl')){
            $back_url=$request->backUrl;
        }else{
            $back_url=route('admin.system.show');
        }

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            // 认证通过...
            return [
                'status'=>200,
                'msg'=>'登录成功',
                'backUrl'=>$back_url
            ];
        }else{
            return [
                'status'=>10001,
                'msg'=>'用户名或密码错误',
                'backUrl'=>''
            ];
        }
    }

    /**
     * 退出登录
     * @author mohuishou<1@lailin.xyz>
     * @return mixed
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login.get');
    }


    public function index(Request $request){
        $users=User::all();
        $data=[
            'title'=>'用户管理',
            'users'=>$users,
            'avatar'=>$request->user()->avatar

        ];
        return view('admin.user',$data);
    }

    public function avatar(Request $request){
        return UploadController::picture($request);
    }

    /**
     * 注册
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return mixed
     */
    public function add(Request $request){
        $this->validate($request, [
            'username' => 'required|max:20|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password' => 'required|max:20',
            'avatar' => 'required|max:20',
        ]);


        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' =>$request->avatar
        ]);

        return [
            'status'=>200,
            'msg'=>'添加成功'
        ];
    }

    public function destroy(Request $request){
        $this->validate($request, [
            'id'=>'required'
        ]);

        if($request->id==$request->user()->id)
            return [
                'status'=>20056,
                'msg'=>'删除错误，不允许删除当前用户'
            ];

        $users=User::all();
        if(count($users)==1)
            return [
                'status'=>20036,
                'msg'=>'删除错误，当前只剩下最后一位用户'
            ];



        User::destroy($request->id);


        return [
            'status'=>200,
            'mag'=>'删除成功！'
        ];
    }

    /**
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     */
    public function update(Request $request){
        $this->validate($request, [
            'id'=>'required'
        ]);

        $user=User::find($request->id);
        $user->name=$request->username;
        $user->email=$request->email;
        $user->avatar=$request->avatar;
        $user->save();

        return [
            'status'=>200,
            'msg'=>'更新成功'
        ];
    }


}