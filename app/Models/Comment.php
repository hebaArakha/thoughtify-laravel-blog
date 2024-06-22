<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['author_id' , 'content' , 'article_id'];


    public function author(){
        return $this->BelongsTo(User::class ,'author_id' );
    }
    public function article(){
        return $this->BelongsTo(Article::class ,'article_id' );
    }
}
