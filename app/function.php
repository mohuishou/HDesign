<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/3/1 0001
 * Time: 16:14
 */

function sConfig($name){
    $sys=App\System::all();
    $data=[];
    foreach ($sys as $k=>$v){
        $data[$v['name']]=$v['value'];
    }
    if(isset($data[$name])){
        return $data[$name];
    }else{
        return '没有值';
    }
}
