<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];
    public function albums()
    {
        return $this->hasMany('App\Album','cid');
    }
}
