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
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller{

    /**
     * @author mohuishou<1@lailin.xyz>
     */
    public function index(Request $request){
        $sliders=Slider::all();
        $albums=Album::all();
        $data=[
            'title'=>'首页轮播',
            'sliders'=>$sliders,
            'albums'=>$albums,
            'avatar'=>$request->user()->avatar
        ];
        return view('admin.slider',$data);
    }

    public function update(Request $request){
        $this->validate($request, [
            'aid' => 'required|numeric',
        ]);
        $slider=new Slider();
        if($request->has('id')){
            $slider=Slider::find($request->id);
        }
        $slider->aid=$request->aid;
        if($slider->save()){
            return [
                'status'=>200,
                'msg'=>'更新成功'
            ];
        }else{
            return [
                'status'=>20008,
                'msg'=>'更新失败'
            ];
        }



    }


}