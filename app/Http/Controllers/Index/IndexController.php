<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/4 0004
 * Time: 13:54
 */
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Slider;

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
    public function category(){
        
    }

    public function album(){

    }







}