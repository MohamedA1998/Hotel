<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'blog_categorie_id' , 'PostTitile' , 'PostSlug' , 'ShortDesc' , 'LongDesc'];

    public function images():MorphOne
    {
        return $this->morphOne(Image::class , 'imagable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function blogcat()
    {
        return $this->belongsTo(BlogCategorie::class , 'blog_categorie_id' , 'id' );
    }


    // public function comment()
    // {
    //     return $this->hasMany(Comment::class);
    // }


}
