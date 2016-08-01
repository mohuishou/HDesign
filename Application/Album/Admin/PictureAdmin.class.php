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
        $pictures=D('Picture')->where('aid='.$aid)->order('sort desc')->select();
        $album_data=D('Album')->find($aid);
        $this->assign('meta_title', "照片管理");
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
        $base_path= dirname(dirname(dirname(dirname(__FILE__))));
        $pic_path=$re['path'];


        $image = new \Think\Image();
        $image->open($pic_path);
        $thumb_path_r='./Uploads/thumb/'.md5($re['name']).".jpg";
        $thumb_path=$thumb_path_r;
        // 按照原图的比例生成一个的缩略图并保存为thumb.jpg
        try {
            $image->thumb(286, 190)->save($thumb_path);
        }catch (Exception $e){
            $this->error("生成缩略图错误");
        }

        if($re['success']){
            $picture_object=D('Picture');
            $data['aid']=$aid;
            $data['pid']=$re['id'];
            $data['thumb']=$thumb_path_r;
            $res=$picture_object->create($data);

            if(!$res){
                $this->error('入库错误','');
            }

            $res_pic=$picture_object->add();

            if($res_pic){

                //检测是否存在封面图片，不存在时设置该图片为封面
                $album_data=D('Album')->find($aid);
                if(!$album_data['cover']){
                    $album_obj=D('Album');
                    $album_obj->cover=$picture_object->order('id desc')->getField('id');
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

    /**
     * @author mohuishou<1@lailin.xyz>
     * @param $id
     * @param $aid
     */
    public function del($id,$aid){
        $album_data=D('Album')->find($aid);
        $pic_count=D('Picture')->where('aid='.$aid)->count();
        if($album_data['cover']==$id){
            if($pic_count>1)
                $this->error('封面图片仅支持最后删除');
        }

        $re=D('Picture')->delete($id);

        //当删除最后一张图片时重置封面
        if($pic_count<=1){
            $res=D('Album')->where('id='.$aid)->data(['cover'=>0])->save();
            if(!$res){
                $this->error('删除成功，封面重置失败');
            }
        }

        if($re){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 排序
     * @author mohuishou<1@lailin.xyz>
     * @param $pid
     * @param $sort
     */
    public function sortPic($id=0,$sort=0){
        $id || $id=I('id');
        $sort || $sort=I('sort');
        $re=D('Picture')->where('id='.$id)->data(['sort'=>$sort])->save();
        if($re){
            $this->success('设置排序成功');
        }else{
            $this->error('设置排序失败');
        }
    }



}