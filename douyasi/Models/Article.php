<?php

namespace Douyasi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 内容模型
 */
class Article extends Model
{
    protected $table = 'articles_';

    protected $primaryKey = 'id';

    protected $fillable = [
                            'title',
                            'flag',
                            'thumb',
                            'slug',
                            'cid',
                            'description',
                            'content',
                        ];

    public function setTable($slug)
    {
       $this->table = $this->table.($slug % 100);
    }


    public function category()
    {
        //模型名 外键 本键
        return $this->hasOne('Douyasi\Models\Category', 'id', 'cid');
    }

    public function user()
    {
        //模型名 外键 本键
        return $this->hasOne('Douyasi\Models\Users', 'id', 'cid');
    }

}
