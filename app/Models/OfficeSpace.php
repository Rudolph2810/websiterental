<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;   
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class OfficeSpace extends Model
{
    use HasFactory, SoftDeletes; 
    //
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'address',
        'city_id',
        'is_open',
        'is_full_booked',
        'price',
        'duration'
    ]; 

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        // gunanya untuk membuat slug otomatis ketika nama diubah. slug adalah versi yang lebih bersih dari nama, biasanya digunakan dalam URL
        $this->attributes['slug'] = Str::slug($value);
        // gunanya untuk membuat slug otomatis ketika nama diubah. slug adalah versi yang lebih bersih dari nama, biasanya digunakan dalam URL
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function benefits() :HasMany
    // ketika setelah function ada huruf s di belakang, itu artinya relasinya one to many. ketika tidak ada huruf s di belakang, itu artinya relasinya one to one
    // hasMany itu artinya relasinya one to many, karena office space bisa memiliki banyak office space benefit. sedangkan office space benefit hanya bisa memiliki satu office space
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }

    public function photos() : HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }
}