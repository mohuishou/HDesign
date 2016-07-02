<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];
}
