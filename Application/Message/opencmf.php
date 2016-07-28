<?php
return array(
    // 模块信息
    'info' => array(
        'name'        => 'Message',
        'title'       => '留言',
        'icon'        => 'fa fa-newspaper-o',
        'icon_color'  => '#9933FF',
        'description' => '留言模块',
        'developer'   => '莫回首',
        'website'     => 'http://lxl520.com',
        'version'     => '1.0.0',
        'dependences' => array(
            'Admin'   => '1.1.0',
        )
    ),

    // 用户中心导航
    'user_nav' => array(

    ),

    // 模块配置
    'config' => array(

    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        '1' => array(
            'id'    => '1',
            'pid'   => '0',
            'title' => '留言',
            'icon'  => 'fa fa-newspaper-o',
        ),
        '2' => array(
            'pid'   => '1',
            'title' => '内容管理',
            'icon'  => 'fa fa-folder-open-o',
        ),
        '3'=> array(
            'pid'   => '2',
            'title' => '留言管理',
            'icon'  => 'fa fa-folder-open-o',
            'url'   => 'Message/index/index'
        ),

    )
);
