<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/1 0001
 * Time: 17:19
 */
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 * 目录、导航
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    public function index(Request $request){
        $categories=Category::where('pid',$request->pid)->get();
        $data=[
            'title'=>$request->title.'下的栏目',
            'categories'=>$categories
        ];
        return view('admin.category',$data);
    }

    /**
     * [add description]
     * @param Request $request [description]
     */
    public function add(Request $request){
        $this->validate($request, [
            'en_title' => 'required|max:50|not_in:categories',
            'cn_title'=>'required|max:50',
            'pid' => 'required|numeric',
        ]);

        $cat=Category::create($request->all());
        $cat->save();

        return [
            'status'=>200,
            'msg'=>'添加成功'
        ];
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request){
        $this->validate($request, [
            'en_title' => 'required|max:50',
            'cn_title'=>'required|max:50',
            'pid' => 'required|numeric',
        ]);

        $cat=Category::find($request->id);

        $cat->save($request->all());
    }

    public function destroy(){

    }



}
