<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // public function blogs(){
    //     return $this->belongsToMany(blog::class)->as('blogs');
    // }

    public function blogs()
    {
        return $this->morphedByMany(Blog::class,'taggable');
    }

    public function comments()
    {
        return $this->morphedByMany(Blog::class,'taggable');
    }
}
