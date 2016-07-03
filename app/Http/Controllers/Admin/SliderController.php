<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/3 0003
 * Time: 23:25
 */
namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Slider;

class SliderController extends Controller{

    /**
     * @author mohuishou<1@lailin.xyz>
     */
    public function index(){
        $sliders=Slider::all();
        $albums=Album::all();
        $data=[
            'title'=>'首页轮播',
            'sliders'=>$sliders,
            'albums'=>$albums
        ];
        return view('admin.slider',$data);
    }

    public function update(Request $request){
        
    }


}