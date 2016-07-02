<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/6/30 0030
 * Time: 16:10
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller{
    function index(Request $request){
//        config(['mohuishou.web_name' => 'test']);
        echo config('mohuishou.web_name', '啥也没');
        echo 123;
//        return $request->user();
        return view('admin.index');
    }
}