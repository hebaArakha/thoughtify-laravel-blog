<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];
    protected $fillable = ['content', 'thumbnail_url', 'title', 'author_id'];


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
}
