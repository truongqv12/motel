<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $table      = 'reports';
    protected $primaryKey = 'id';
    protected $guarded    = [];

    public function motel()
    {
        return $this->belongsTo(MotelRoom::class,'motelroom_id','id');
    }

    public function info()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
