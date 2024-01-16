<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'blog_post_id' , 'message'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function blogpost()
    {
        return $this->belongsTo(BlogPost::class , 'blog_post_id' , 'id');
    }



}
