<?php

namespace App\Models;

use App\Models\Scopes\DeletedAdminScope;
use App\Models\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Blog extends Model
{
    use HasFactory, SoftDeletes,Taggable;

    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
            return $this->morphMany(Comment::class,'commentable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function scopeLatest(Builder $builder)
    {
        return $builder->orderBy('created_at', 'desc');
    }

    public function scopeMostCommentBlog(Builder $builder)
    {
        return $builder->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelation(Builder $builder)
    {
        return $builder
            ->latest()
            ->withCount('comments')
            ->with(['author', 'tags'])
            ->get();
    }



    public static function boot()
    {
        self::addGlobalScope(new DeletedAdminScope());
        parent::boot();
        self::deleting(function (Blog $blog) {
            $blog->comments()->delete();
            Cache::tags(['blogs'])->forget("show-blog-{$blog->id}");
        });

        self::updating(function (Blog $blog) {
            Cache::tags(['blogs'])->forget("show-blog-{$blog->id}");
        });
        self::restoring(function (Blog $blog) {
            $blog->comments()->restore();
        });
    }
}
