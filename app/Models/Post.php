<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'pos_id';

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class,'pos_category_id','cat_id');
    }

}
