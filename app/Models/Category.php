<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'cat_id';

    protected $guarded = [];

    public function childs()
    {
        return $this->hasMany(
            static::class,
            'cat_parent_id',
            'cat_id'
        );
    }

//    public function products() {
//        return $this->hasMany(static::class,'cat_parent_id','cat_id');
//    }

}
