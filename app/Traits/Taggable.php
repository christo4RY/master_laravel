<?php

namespace App\Traits;

use App\Models\Tag;

trait Taggable
{
    public static function bootTaggable()
    {
        static::updating(function ($model) {
            $model->tags()->sync(static::findTags($model->content));
        });

        static::created(function ($model) {
            $model->tags()->sync(static::findTags($model->content));
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable')->as('tagging');
    }

    protected static function findTags($content)
    {
        preg_match_all('/@([^@]+)@/m',$content,$tags);

        return Tag::whereIn('name',$tags[1]??[])->get();
    }
}
