<?php
namespace Message\Controller;
use Home\Controller\HomeController;
use Common\Util\Think\Page;
/**
 * 默认控制器
 * @author jry <598821125@qq.com>
 */
class IndexController extends HomeController {

    public function add(){
        if (IS_POST) {
            //新增留言
            $album_object = D('Index');
            if(!$album_object->create()){
                $this->error($album_object->getError());
            }else{
                $album_object->add();
                $this->success('新增成功', U('index'));
            }
        }
    }



   }