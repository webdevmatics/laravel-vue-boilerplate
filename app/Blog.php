<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'content', 'published_at', 'status','slug'];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category','blog_id','category_id' );
    }

}
