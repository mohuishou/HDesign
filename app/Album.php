<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function categories(){
        return $this->belongsTo('App\Category','cid');
    }

    public function pictures()
    {
        return $this->belongsToMany('App\Picture');
    }

    public function sliders(){
        return $this->belongsTo('App\Slider','aid');
    }
}
