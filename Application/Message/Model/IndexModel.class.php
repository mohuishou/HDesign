<?php
namespace Message\Model;
use Think\Model;
/**
 * 分类模型
 * @author mohuishou <1@lailin.xyz>
 */
class IndexModel extends Model
{
    /**
     * 模块名称
     * @author mohuishou <1@lailin.xyz>
     */
    public $moduleName = 'Message';


    protected $tableName = 'message_index';

    /**
     * 自动验证规则
     * @author mohuishou <1@lailin.xyz>
     */
    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '2,5', '名称长度为2-5个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array('email', 'require', '邮箱不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('message', 'require', '留言不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
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

//


        return $return_list;

    }

}