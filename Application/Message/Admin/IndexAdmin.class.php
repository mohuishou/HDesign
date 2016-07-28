<?php
namespace Message\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;

/**
 * 后台留言管理控制器
 * Class IndexAdmin
 * @package Album\Admin
 */
class IndexAdmin extends AdminController {
    /**
     * @author mohuishou<1@lailin.xyz>
     */
    public function index() {

//

            //获取留言信息
            $map = array();
            $map['status'] = array('egt', 0);

            $album_lists=D('Index')->where($map)->select();

            //分页
//            $base_table = C('DB_PREFIX').D('Index')->tableName;
            $page = new Page(D('Index')->where($map)
                  ->count(), C('ADMIN_PAGE_ROWS'));


            //使用Builder快速建立列表页面。
            $builder = new \Common\Builder\ListBuilder();
            $builder->setMetaTitle('留言管理') //设置页面标题
                    ->addTopButton('addnew', array('href' => U('add'))) //添加新增按钮
                    ->addTopButton('resume', array('model' => D('Index')->tableName))  //添加启用按钮
                    ->addTopButton('forbid', array('model' => D('Index')->tableName))  //添加禁用按钮
                    ->addTableColumn('id', 'ID')
                    ->addTableColumn('name', '姓名')
                    ->addTableColumn('message', '留言')
                    ->addTableColumn('tel', '手机号')
                    ->addTableColumn('email', '邮箱')
                    ->addTableColumn('create_time', '发布时间', 'time')
                    ->addTableColumn('status', '状态', 'status')
                    ->addTableColumn('right_button', '操作', 'btn')
                    ->setTableDataList($album_lists) //数据列表
                    ->setTableDataPage($page->show())  //数据列表分页
                    ->addRightButton('edit')    //添加编辑按钮
                    ->addRightButton('forbid')  //添加禁用/启用按钮
                    ->addRightButton('delete')  //添加禁用/启用按钮
                    ->display();

    }

    /**
     * 新增留言
     * @author mohuishou <1@lailin.xyz>
     */
    public function add() {
        if (IS_POST) {
            //新增留言
            $album_object = D('Index');
            if(!$album_object->create()){
                $this->error($album_object->getError());
            }else{
                $album_object->add();
                $this->success('新增成功', U('index'));
            }
        } else {
            //获取当前分类
            $map['status'] = array('EGT', -1);

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增留言') //设置页面标题
                    ->setPostUrl(U('add')) //设置表单提交地址
                    ->addFormItem('name', 'text', '姓名')
                    ->addFormItem('tel', 'text', '手机号')
                    ->addFormItem('email', 'text', '邮箱')
                    ->addFormItem('message', 'textarea', '留言描述', '留言描述')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->display();
        }
    }

    /**
     * 编辑文章
     * @author mohuishou <1@lailin.xyz>
     */
    public function edit($id) {

        if (IS_POST) {
            //更新留言
            $album_object = D('Index');
            if(!$album_object->create()){
                $this->error($album_object->getError());
            }else{
                $album_object->save();
                $this->success('更新成功', U('index'));
            }
        } else {
            //获取当前分类
            $data=D('Index')->find($id);

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增留言') //设置页面标题
            ->setPostUrl(U('edit')) //设置表单提交地址
            ->addFormItem('name', 'text', '姓名')
                ->addFormItem('id', 'hidden', '手机号')
                ->addFormItem('tel', 'text', '手机号')
                ->addFormItem('email', 'text', '邮箱')
                ->addFormItem('message', 'textarea', '留言描述', '留言描述')
                ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                ->setFormData($data)
                ->display();
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
                    $result2 = D('Index')->delete($ids);
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
