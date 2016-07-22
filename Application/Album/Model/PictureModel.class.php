<?php
namespace Album\Model;
use Think\Model;
/**
 * 分类模型
 * @author mohuishou <1@lailin.xyz>
 */
class PictureModel extends Model
{
    /**
     * 模块名称
     * @author mohuishou <1@lailin.xyz>
     */
    public $moduleName = 'Album';


    protected $tableName = 'album_picture';

    /**
     * 自动验证规则
     * @author mohuishou <1@lailin.xyz>
     */
    protected $_validate = array(
        array('aid', 'require', '图集id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('pid', 'require', '图片id不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     * @author mohuishou <1@lailin.xyz>
     */
    protected $_auto = array(
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
        array('view', '0', self::MODEL_INSERT),
    );
}