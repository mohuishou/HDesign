<?php
/**
 * Created by mohuishou<1@lailin.xyz>.
 * User: mohuishou<1@lailin.xyz>
 * Date: 2016/7/3 0003
 * Time: 18:13
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPicture extends Model
{
    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['created_time'];

    protected $table='album_picture';

    
}
