<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/3 0003
 * Time: 23:33
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function albums()
    {
        return $this->hasOne('App\Albums','aid');
    }
}