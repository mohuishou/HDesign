<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/4 0004
 * Time: 13:54
 */
namespace App\Http\Controllers\Index;

use App\Album;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller{

    /**
     * @author mohuishou<1@lailin.xyz>
     * @return mixed
     */
    public function index(){
        $sliders=Slider::all();
        $data=[
            'title'=>'首页',
            'sliders'=>$sliders
        ];
        return view('index.index',$data);
    }


    /**
     * @author mohuishou<1@lailin.xyz>
     */
    public function category($cid){

        $cate=Category::find($cid);

        if($cate->pid!=0){
            $album=$cate->albums;
            $title=$cate->cn_title;
            $pid=$cate->pid;
            $cate=Category::find($pid);
            $cate_two=Category::where('pid',$pid)->get();
        }else{
            $cate_two=Category::where('pid',$cid)->get();
            $album=$cate_two->get(0)->albums;
            $title=$cate->cn_title.'|'.$cate_two->get(0)->cn_title;
        }

        $data=[
            'title'=>$title,
            'category'=>$cate,
            'category_two'=>$cate_two,
            'albums'=>$album
        ];
        return view('index.category',$data);

    }

    /**
     * [album description]
     * @param  [type] $aid [description]
     * @return [type]      [description]
     */
    public function album($aid){
//        $this->validate($request, [
//            'aid' => 'required|numeric',
//        ]);

        $album=Album::find($aid);

        $pictures=$album->pictures;

        $data=[
            'title'=>$album->en_title."|".$album->cn_title,
            'pictures'=>$pictures,
            'album'=>$album
        ];

        return view('index.album',$data);

    }







}
