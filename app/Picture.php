<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function albums()
    {
        return $this->belongsToMany('App\Albums')->withPivot('id','sort');
    }
}
