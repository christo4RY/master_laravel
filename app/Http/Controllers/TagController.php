<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        return view('blog.index', ['blogs' => $tag->blogs]);
    }
}
