<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'postion' , 'facebook'];

    // Image Relationships Morph
    public function images():MorphOne
    {
        return $this->morphOne(Image::class , 'imagable');
    }

}
