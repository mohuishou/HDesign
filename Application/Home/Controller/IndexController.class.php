<?php

namespace Home\Controller;
use Think\Controller;
/**
 * 前台默认控制器
 * @author mohuishou <1@lailin.xyz>
 */
class IndexController extends HomeController {
    /**
     * 默认方法
     * @author mohuishou <1@lailin.xyz>
     */
    public function index() {
        Cookie('__forward__', C('HOME_PAGE'));

        //首页幻灯片
        $map['status']=array("eq", '1');//只有启用状态的可以显示
        $slider_data=D('Album/Slider')->where($map)->order('sort desc')->select();
        $album_obj=D('Album/Album');
        $pic_obj=D('Album/Picture');
        foreach ($slider_data as &$v){
            $album_data=$album_obj->find($v['aid']);
            $v['title']=$album_data['title'];
            $v['en_title']=$album_data['en_title'];
            $v['cover']=$pic_obj->find($album_data['cover'])['pid'];
        }

        $this->assign('meta_title', "首页");
        $this->assign('sliders',$slider_data);
        $this->display();
    }


}
