<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotelAmenities extends Model
{
    protected $table      = 'motelroom_amenities';
    protected $primaryKey = 'id';
    protected $guarded    = [];
    public    $timestamps = false;
}
