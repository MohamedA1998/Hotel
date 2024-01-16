<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategorie extends Model
{
    use HasFactory;
    protected $fillable = ['CategoryName' , 'CategorySlug'];

    public function blogpost()
    {
        return $this->hasMany(BlogPost::class);
    }

    
}
