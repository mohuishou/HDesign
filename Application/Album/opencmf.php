<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.opencmf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------
// 模块信息配置
return array(
    // 模块信息
    'info' => array(
        'name'        => 'Album',
        'title'       => 'Album',
        'icon'        => 'fa fa-newspaper-o',
        'icon_color'  => '#9933FF',
        'description' => '图集模块',
        'developer'   => '莫回首',
        'website'     => 'http://lxl520.com',
        'version'     => '1.0.0',
        'dependences' => array(
            'Admin'   => '1.1.0',
        )
    ),

    // 用户中心导航
    'user_nav' => array(
        'center' => array(
            '0' => array(
                'title' => '我的文档',
                'icon'  => 'fa fa-list',
                'url'   => 'Cms/Index/my',
            ),
        ),
    ),

    // 模块配置
    'config' => array(

    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        '1' => array(
            'id'    => '1',
            'pid'   => '0',
            'title' => '相册',
            'icon'  => 'fa fa-newspaper-o',
        ),
        '2' => array(
            'pid'   => '1',
            'title' => '内容管理',
            'icon'  => 'fa fa-folder-open-o',
        ),
        '3'=> array(
            'pid'   => '2',
            'title' => '栏目设置',
            'icon'  => 'fa fa-folder-open-o',
            'url'   => 'Album/category/index'
        ),
        '4'=> array(
            'pid'   => '2',
            'title' => '相册管理',
            'icon'  => 'fa fa-folder-open-o',
            'url'   => 'Album/index/index'
        ),
        '5'=> array(
            'pid'   => '2',
            'title' => '轮播管理',
            'icon'  => 'fa fa-folder-open-o',
            'url'   => 'Album/slider/index'
        ),
    )
);
