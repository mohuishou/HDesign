<?php
namespace Album\Controller;
use Home\Controller\HomeController;
use Common\Util\Think\Page;
/**
 * 默认控制器
 * @author jry <598821125@qq.com>
 */
class IndexController extends HomeController {

    public function index($cid){
        $cate=D('Category')->find($cid);
        $map['status']=['eq',1];
        $order='sort desc';

        //目录不是一级目录的时候
        if($cate['pid']!=0){

            //查找该栏目下的图集
            $album_map=$map;
            $album_map['cid']=$cid;
            $album=D('Album')->where($album_map)->order($order)->select();

            //这是标题
            $meta_title=$cate['title'];

            //查找与该目录同级的二级目录
            $pid=$cate['pid'];
            $cate=D('Category')->find($pid);
            $cate_map=$map;
            $cate_map['pid']=$pid;
            $cate_two=D('Category')->where($cate_map)->order($order)->select();

        }else{
            //当目录为一级目录时

            //查找该目录下属的二级目录
            $cate_two=D('Category')->where('pid='.$cid)->order($order)->select();

            //获取第一个二级目录的图集
            $album_map=$map;
            $album_map['cid']=$cate_two[0]['id'];
            $album=D('Album')->where($album_map)->order($order)->select();

            //设置标题
            $meta_title=$cate['title'];
        }

        $pic_obj=D('Picture');

        foreach ($album as &$v){
            $v['cover']=$pic_obj->find($v['cover'])['pid'];
        }

        $this->assign('meta_title',$meta_title);
        $this->assign('cate',$cate);
        $this->assign('category_two',$cate_two);
        $this->assign('albums',$album);
        $this->display();


//        print_r($cate);
//        print_r($cate_two);
//        print_r($album);
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

        $map['status']=['eq',1];
        $map['aid']=$aid;
        $order='sort desc';

        $album=D('Album')->find($aid);

        $pictures=D('Picture')->where($map)->order($order)->select();

        $this->assign('album',$album);
        $this->assign('pictures',$pictures);
        $this->assign('meta_title',$album['en_title']."|".$album['title']);

//        print_r($album);
//        print_r($pictures);

        $this->display();


    }

   }