<?php
namespace Album\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;

/**
 * 后台相册管理控制器
 * Class IndexAdmin
 * @package Album\Admin
 */
class IndexAdmin extends AdminController {
    /**
     * @author mohuishou<1@lailin.xyz>
     * @param int $cid
     */
    public function index($cid = 0) {
        if (!$cid) {
            //使用Builder快速建立列表页面
            $builder = new \Common\Builder\ListBuilder();
            $builder->setMetaTitle('相册管理') //设置页面标题
                    ->setSearch('请输入ID/标题', U('index', array('cid' => $cid)))
                    ->addTableColumn('id', 'ID')
                    ->addTableColumn('create_time', '发布时间', 'time')
                    ->addTableColumn('sort', '排序', 'text')
                    ->addTableColumn('status', '状态', 'status')
                    ->addTableColumn('right_button', '操作', 'btn')
                    ->setExtraHtml('<div class="alert alert-success">请点击左侧的列表树进行操作</div>')
                    ->setTemplate('Builder/list')
                    ->display();
        } else {
            //获取分类信息
            $category_info = D('Category')->find($cid);

//

            //获取图集信息
            $map = array();
            $map['cid'] = $cid;
            $map['status'] = array('egt', 0);

            $album_lists=D('Album')->getList($cid, C('ADMIN_PAGE_ROWS'), $_GET['p'] ? : 1, null, false, $map);

            //分页
            $base_table = C('DB_PREFIX').D('Album')->tableName;
            $page = new Page(D('Album')->where($map)
                  ->count(), C('ADMIN_PAGE_ROWS'));


            //使用Builder快速建立列表页面。
            $builder = new \Common\Builder\ListBuilder();
            $builder->setMetaTitle($category_info['title']) //设置页面标题
                    ->addTopButton('addnew', array('href' => U('add', array('cid' => $cid)))) //添加新增按钮
                    ->addTopButton('resume', array('model' => D('Album')->tableName))  //添加启用按钮
                    ->addTopButton('forbid', array('model' => D('Album')->tableName))  //添加禁用按钮
//                    ->addTopButton('self', $move_attr) //添加移动按钮
                    ->setSearch('请输入ID/标题', U('Album', array('cid' => $cid)))
                    ->addTableColumn('id', 'ID')
                    ->addTableColumn('title_url', '标题')
                    ->addTableColumn('create_time', '发布时间', 'time')
                    ->addTableColumn('sort', '排序', 'text')
                    ->addTableColumn('status', '状态', 'status')
                    ->addTableColumn('right_button', '操作', 'btn')
                    ->setTableDataList($album_lists) //数据列表
                    ->setTableDataPage($page->show())  //数据列表分页
                    ->addRightButton('edit')    //添加编辑按钮
                    ->addRightButton('forbid')  //添加禁用/启用按钮
                    ->addRightButton('delete')  //添加禁用/启用按钮
//                    ->setExtraHtml($extra_html)
                    ->setTemplate('Builder/list')
                    ->display();
        }
    }

    /**
     * 新增图集
     * @author mohuishou <1@lailin.xyz>
     */
    public function add($cid) {
        if (IS_POST) {
            //新增图集
            $album_object = D('Album');
            if(!$album_object->create()){
                $this->error($album_object->getError());
            }else{
                $album_object->add();
                $this->success('新增成功', U('index', array('cid' => I('post.cid'))));
            }
        } else {
            //获取当前分类
            $category_info = D('Category')->find($cid);
            $map['status'] = array('EGT', -1);

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增图集') //设置页面标题
                    ->setPostUrl(U('add')) //设置表单提交地址
                    ->addFormItem('cid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Category', $map))
                    ->addFormItem('title', 'text', '图集标题', '图集标题')
                    ->addFormItem('en_title', 'text', '英文标题', '英文标题')
                    ->addFormItem('description', 'textarea', '图集描述', '图集描述')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->setFormData(array('cid' => $category_info['id']))
                    ->setTemplate('Builder/form')
                    ->display();
        }
    }

    /**
     * 编辑文章
     * @author mohuishou <1@lailin.xyz>
     */
    public function edit($id) {


        if (IS_POST) {
            //更新图集
            $album_object = D('Album');
            $result = $album_object->create();
            if (!$result) {
                $this->error($album_object->getError());
            } else {
                $album_object->save();
                $this->success('更新成功', U('index', array('cid' => I('post.cid'))));
            }
        } else {
            $map['status'] = array('EGT', -1);
            $album_info=D('Album')->find($id);

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增图集') //设置页面标题
            ->setPostUrl(U('edit')) //设置表单提交地址
            ->addFormItem('cid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Category', $map))
                ->addFormItem('title', 'text', '图集标题', '图集标题')
                ->addFormItem('id', 'hidden')
                ->addFormItem('en_title', 'text', '英文标题', '英文标题')
                ->addFormItem('description', 'textarea', '图集描述', '图集描述')
                ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                ->setFormData($album_info)
                ->setTemplate('Builder/form')
                ->display();
        }
    }

    /**
     * 移动图集
     * @author mohuishou <1@lailin.xyz>
     */
    public function move() {
        if (IS_POST) {
            $ids = I('post.ids');
            $from_cid = I('post.from_cid');
            $to_cid = I('post.to_cid');
            if ($from_cid === $to_cid) {
                $this->error('目标分类与当前分类相同');
            }
            if ($to_cid) {
                $category_model = D('Category');
                $form_category_type = $category_model->getFieldById($from_cid, 'doc_type');
                $to_category_type = $category_model->getFieldById($to_cid, 'doc_type');
                if ($form_category_type === $to_category_type) {
                    $map['id'] = array('in',$ids);
                    $data = array('cid' => $to_cid);
                    $this->editRow('Index', $data, $map, array('success'=>'移动成功','error'=>'移动失败'));
                } else {
                    $this->error('该分类模型不匹配');
                }
            } else {
                $this->error('请选择目标分类');
            }
        }
    }


    /**
     * 设置一条或者多条数据的状态
     * @author mohuishou <1@lailin.xyz>
     */
    public function setStatus($model = CONTROLLER_NAME) {
        $ids    = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        $map['id'] = array('in',$ids);
        switch ($status) {
            case 'delete' :  // 删除条目
                //检测Album下面是否存在图片，存在不允许删除
                $result=1;

                if ($result) {
                    $result2 = D('Album')->delete($ids);
                    if ($result2) {
                        $this->success('彻底删除成功');
                    } else {
                        $this->error('删除失败');
                    }
                } else {
                    $this->error('删除失败');
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }
}
