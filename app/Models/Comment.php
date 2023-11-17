<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['content','blog_id','user_id'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function(Comment $comment){
            Cache::tags(['blogs'])->forget("show-blog-{$comment->blog_id}");
            Cache::tags(['blogs'])->forget("mostCommentedBlogs");
        });
    }
}
