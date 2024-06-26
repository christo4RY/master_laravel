<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
        'local'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsOn()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function scopeWithMostBlogPosts(Builder $builder){
        return $builder->withCount('blogs')->orderBy('blogs_count','desc');
    }

    public  function scopeWithMostBlogPostsLastMonth(Builder $builder){
        return $builder->withCount(['blogs'=>function(Builder $query){
            return $query->whereBetween(static::CREATED_AT,[now()->subMonth(1),now()]);
        }])->having('blogs_count','>=',2)->orderBy('blogs_count','desc');
    }

    public function scopeGetAdmin(Builder $builder){
        return $builder->where('isAdmin',true);
    }
}
