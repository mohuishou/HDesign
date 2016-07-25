<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.opencmf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------

//开发者二次开发公共函数统一写入此文件，不要修改function.php以便于系统升级。

/**
 * 获取一级目录，包括图集相册，新闻、留言等模块
 * @author mohuishou<1@lailin.xyz>
 */
function getCategory(){
    $album_cat=D('Album/Category')->getCategoryTree();
    $cms_cat=D('Cms/Category')->getCategoryTree();
    $categories=array_merge($album_cat,$cms_cat);
    return $categories;
}