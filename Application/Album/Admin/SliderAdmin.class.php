<?php
namespace Album\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;
/**
 * 幻灯片控制器
 * @author mohuishou <1@lailin.xyz>
 */
class SliderAdmin extends AdminController {
    /**
     * 默认方法
     * @author mohuishou <1@lailin.xyz>
     */
    public function index() {
        $map['status']=array("eq", '1');//只有启用状态的可以显示
        $slider_data=D('Slider')->where()->order('sort desc')->select();
        $album_obj=D('Album');
        $pic_obj=D('Picture');
        foreach ($slider_data as &$v){
            $album_data=$album_obj->find($v['aid']);
            $v['title']='<a target="_blank" href="'.U('Album/Picture/index', array('aid' => $album_data['id'])).'">'.$album_data['title'].'</a>';
            $v['cover']=$pic_obj->find($album_data['cover'])['pid'];
        }

        print_r($slider_data);

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('幻灯列表')  // 设置页面标题
                ->addTopButton('addnew')    // 添加新增按钮
                ->addTopButton('resume')  // 添加启用按钮
                ->addTopButton('forbid')  // 添加禁用按钮
                ->addTableColumn('id', 'ID')
                ->addTableColumn('cover', '图集封面', 'picture')
                ->addTableColumn('title', '图集标题')
                ->addTableColumn('create_time', '创建时间', 'time')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($slider_data)     // 数据列表
                ->addRightButton('edit')           // 添加编辑按钮
                ->addRightButton('forbid')  // 添加禁用/启用按钮
                ->addRightButton('delete')  // 添加删除按钮
                ->setExtraHtml('<div class="alert alert-success">注意：在启用的幻灯片数目大于5条时前台只会显示前五条</div>')
                ->display();
    }

    /**
     * 新增文档
     * @author mohuishou <1@lailin.xyz>
     */
    public function add() {
        if (IS_POST) {
            $slider_object = D('Slider');
            $data = $slider_object->create();
            if ($data) {
                $id = $slider_object->add();
                if ($id) {
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($slider_object->getError());
            }
        } else {
            $map['status'] = array('EGT', -1);
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增幻灯')  // 设置页面标题
                    ->setPostUrl(U('add'))      // 设置表单提交地址
                    ->addFormItem('aid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Album', $map,'选择图集'))
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
            $slider_object = D('Slider');
            $data = $slider_object->create();
            if ($data) {
                $id = $slider_object->save();
                if ($id !== false) {
                    $this->success('更新成功', U('index'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($slider_object->getError());
            }
        } else {
            $slider_datas=D('Slider')->find($id);
            $map['status'] = array('EGT', -1);
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('更新幻灯')  // 设置页面标题
                ->setPostUrl(U('edit'))      // 设置表单提交地址
                ->addFormItem('aid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Album', $map,'选择图集'))
                ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                ->addFormItem('id', 'hidden', 'id')
                ->setFormData($slider_datas)
                ->display();
        }
    }
}
