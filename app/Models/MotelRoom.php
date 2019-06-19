<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotelRoom extends Model
{
    protected $table      = 'motelrooms';
    protected $primaryKey = 'id';
    protected $guarded    = [];

    public function scopeCity($query)
    {
        return empty(request()->hot) ? $query : $query->where('hot', request()->hot);
    }

    public function city()
    {
        return $this->belongsTo(
            Cities::class,
            'cty_id',
            'cit_id'
        );
    }

    public function amenities()
    {
        return $this->belongsToMany(
            Amenities::class,
            'motelroom_amenities',
            'motelroom_id',
            'amenities_id'
        );
    }

    public function district()
    {
        return $this->belongsTo(
            Cities::class,
            'dis_id',
            'cit_id'
        );
    }

    public function ward()
    {
        return $this->belongsTo(
            Cities::class,
            'war_id',
            'cit_id'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'cat_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'use_id',
            'id'
        );
    }

    public function scopeStatus($query)
    {
        return (request()->status == "") ? $query : $query->where('status', '=', request()->status);
    }

    public function scopeAddress($query)
    {
        return empty(request()->address) ? $query : $query->where('address', 'like', '%' . request()->address . '%');
    }

    public function scopeTitle($query)
    {
        return empty(request()->title) ? $query : $query->where('title', 'like', '%' . request()->title . '%');
    }

    public function scopeCity_id($query)
    {
        return empty(request()->city) ? $query : $query->where('cty_id', request()->city);
    }

    public function scopeDistrict_id($query)
    {
        return empty(request()->district) ? $query : $query->where('dis_id', request()->district);
    }

    public function scopePrice($query)
    {
        $arr_price = explode(';', request()->price);
        return empty(request()->price) ? $query : $query->whereBetween('price', $arr_price);
    }

//
    public function scopeAmenities($query)
    {
        $amenities_id = request()->amenities;

        return empty(request()->amenities) ? $query : $query->whereHas('amenities', function ($query) use ($amenities_id) {
            $query->whereIn('motelroom_amenities.amenities_id', $amenities_id);
        });
    }

}
