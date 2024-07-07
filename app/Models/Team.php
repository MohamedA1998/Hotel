<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'postion' , 'facebook' , 'image'];

}
