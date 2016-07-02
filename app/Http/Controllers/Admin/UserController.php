<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/6/30 0030
 * Time: 17:24
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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
            $back_url=route('admin.test');
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


    /**
     * 注册
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required|max:20',
            'email'=>'required|email',
            'password' => 'required',
        ]);


        return User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }


    public function update(Request $request){
        
    }


}