<?php
namespace Album\Model;
use Think\Model;
/**
 * 分类模型
 * @author mohuishou <1@lailin.xyz>
 */
class AlbumModel extends Model
{
    /**
     * 模块名称
     * @author mohuishou <1@lailin.xyz>
     */
    public $moduleName = 'Album';


    protected $tableName = 'album_albums';

    /**
     * 自动验证规则
     * @author mohuishou <1@lailin.xyz>
     */
    protected $_validate = array(
        array('title', 'require', '名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,32', '名称长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array('title', 'checkTitle', '名称已经存在', self::MUST_VALIDATE, 'callback', self::MODEL_INSERT),
        array('cid', 'require', '分类不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     * @author mohuishou <1@lailin.xyz>
     */
    protected $_auto = array(
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 检查同一分组下是否有相同的字段
     * @author mohuishou <1@lailin.xyz>
     */
    protected function checkTitle() {
        $map['title'] = array('eq', I('post.title'));
        $result = $this->where($map)->find();
        return empty($result);
    }

    /**
     * 获取文章列表
     * @author mohuishou <1@lailin.xyz>
     */
    public function getList($cid, $limit = 10, $page = 1, $order = null, $child = false, $map = null) {
//        $con["cid"] = $cid;
        $con["status"] = array("eq", '1');
        if ($map) {
            $map = array_merge($con, $map);
        }
        if (!$order) {
            $order = 'sort desc';
        }

        $return_list = $this->page($page, $limit)
            ->order($order)
            ->where($map)
            ->select();

        //渲染管理地址
        foreach ($return_list as &$val){
            $val['href'] = U($this->moduleName.'/Picture/index', array('aid' => $val['id']));
            $val['title_url'] = '<a target="_blank" href="'.U($this->moduleName.'/Picture/index', array('aid' => $val['id'])).'">'.$val['title'].'</a>';
        }

        print_r($return_list);

        return $return_list;

    }

}