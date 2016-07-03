<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/1 0001
 * Time: 17:19
 */
namespace App\Http\Controllers\Admin;

use App\Album;
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
            'pid'=>$request->pid,
            'title'=>$request->title.'下的栏目',
            'categories'=>$categories
        ];
        return view('admin.category',$data);
    }

    /**
     * 新增目录
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
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
     * 更新目录
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    public function update(Request $request){
        $this->validate($request, [
            'en_title' => 'required|max:50',
            'cn_title'=>'required|max:50',
            'pid' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        $cat=Category::find($request->id);
        $cat->cn_title=$request->cn_title;
        $cat->en_title=$request->en_title;
        $cat->pid=$request->pid;
        if($cat->save()){
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
     * 删除
     * @author mohuishou<1@lailin.xyz>
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        $id=$request->id;

        $cate=Category::where('pid',$id)->first();
        if(!empty($cate->id))
            return [
                'status'=>20005,
                'msg'=>'删除错误，在该目录下存在子目录！'
            ];

        $album=Album::where('cid','id')->first();

        if(!empty($album->id))
            return [
                'status'=>20005,
                'msg'=>'删除错误，在该目录下存在图集！'
            ];

        Category::find($id)->delete();

        return [
            'status'=>200,
            'msg'=>'删除成功'
        ];

    }



}
