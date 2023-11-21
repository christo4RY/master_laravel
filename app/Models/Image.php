<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['thumnail'];


    public function imageable(){
        return $this->morphTo();
    }

    public function url()
    {
        return Storage::url($this->thumnail);
    }
}
