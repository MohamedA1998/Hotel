<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imageurl()
    {
        // This Return Image Properte From Room model
        return Storage::url($this->image);
    }
    

    
    public function facility()
    {
        return $this->hasMany(Facility::class);
    }


    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }


    public function images()
    {
        return $this->morphMany(Image::class , 'imagable');
    }
    

    public function roomnumber()
    {
        return $this->hasMany(RoomNumber::class);
    }


    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

}
