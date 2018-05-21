<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/19
 * Time: 下午5:09
 */
namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 分类模型
 */
class Users extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'nickname',
        'realname',
        'is_locked'
    ];

}