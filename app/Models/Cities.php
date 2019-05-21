<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table      = 'cities';
    protected $primaryKey = 'cit_id';
    public    $timestamps = false;
    protected $guarded    = [];

    function district()
    {
        return $this->hasMany(static::class, 'cit_parent_id', 'cit_id');
    }
}
