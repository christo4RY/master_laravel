<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory,SoftDeletes ,Taggable;

    protected $fillable = ['content','user_id'];

    public function commentable()
    {
        return $this->morphTo();
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
