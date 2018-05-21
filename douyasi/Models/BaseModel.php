<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/3/20
 * Time: 下午5:27
 */
namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 内容模型
 */
class BaseModel extends Model
{
    protected function  __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable();
    }

}