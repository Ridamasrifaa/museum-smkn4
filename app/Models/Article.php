<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'cover',
        'status',
        'is_featured',
        'published_at',
        'views',
    ];

    protected $casts = [
        'published_at'=>'datetime',
        'is_featured'=>'boolean'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class,'category_id');
    }
    
}