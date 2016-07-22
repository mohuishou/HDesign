<?php
namespace Album\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;

/**
 * 后台相册管理控制器
 * Class IndexAdmin
 * @package Album\Admin
 */
class PictureAdmin extends AdminController {


    public function index($aid){
        $pictures=D('Picture')->where('aid='.$aid)->select();
        $album_data=D('Album')->find($aid);
        $this->assign('pictures',$pictures);
//        print_r($pictures);
        $this->assign('aid',$aid);
        $this->assign('cover',$album_data['cover']);
        $this->display();
    }


    /**
     * @author mohuishou<1@lailin.xyz>
     * @param $aid
     */
    public function add($aid){
        $re=D('Admin/Upload')->upload();

        if($re['success']){
            $picture_object=D('Picture');
            $data['aid']=$aid;
            $data['pid']=$re['id'];
            $res=$picture_object->create($data);

            if(!$res){
                $this->error('入库错误','');
            }

            $res_pic=$picture_object->add();

            if($res_pic){
                $album_data=D('Album')->find($aid);
                if(!$album_data['cover']){
                    $album_obj=D('Album');
                    $album_obj->cover=$picture_object->getField('id');
                    if(!$album_obj->where('id='.$aid)->save()){
                        $this->error('封面设置错误','');
                    }
                }
                $this->success('上传成功','');
            }else{
                $this->error('入库错误','');
            }
        }else{
            $this->error('上传错误,'.$re['message'],'');
        }
    }

    public function del($id,$aid){
        $album_data=D('Album')->find($aid);
        $pic_count=D('Picture')->where('aid='.$aid)->count();
        if($album_data['cover']==$id){
            if($pic_count>1)
                $this->error('封面图片仅支持最后删除');
        }

        $re=D('Picture')->delete($id);

        if($re){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }



}