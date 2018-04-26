<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/18
 * Time: 上午10:38
 */
namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 内容模型
 */
class ArticleDate extends Model
{
    protected $table = 'articles_';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'slug',
        'cid',
        'description',
    ];

    public function setTable($date)
    {
        $this->table = $this->table."$date";

        return $this;
    }


    public function getIndex(){
        $date = date("Ym");
        $this->setTable($date);

    }

    public function category()
    {
        //模型名 外键 本键
        return $this->hasOne('Douyasi\Models\Category', 'id', 'cid');
    }

}
