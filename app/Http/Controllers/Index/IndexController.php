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
    public function category(Request $request){
        $this->validate($request, [
            'cid' => 'required|numeric',
        ]);
    }

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