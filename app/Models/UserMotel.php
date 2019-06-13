<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMotel extends Model
{
    protected $table      = 'user_motel';
    protected $primaryKey = 'id';
    protected $guarded    = [];
    public    $timestamps = false;

    public function motel()
    {
        return $this->belongsTo(MotelRoom::class,'motelroom_id','id');
    }

    public function info()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
