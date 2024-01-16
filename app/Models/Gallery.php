<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images():MorphOne
    {
        return $this->morphOne(Image::class , 'imagable');
    }
}
