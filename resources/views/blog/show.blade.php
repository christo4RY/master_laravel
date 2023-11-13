@extends('layout.app')

@section('title',$blog->title)

@section('content')
<div class="w-full sm:w-[60%] space-y-5 lg:w-[50%] mx-auto p-4 border shadow-lg rounded">
    <h1 class="text-2xl">{{$blog->title}}</h1>
    <p class="text-lg">{{$blog->content}}</p>
    <div>
        {{$counter}} Views
    </div>
    <div>
        <h4 class="text-xl">Comments</h4>
        @forelse ($blog->comments as $comment)
            @component('components.comment',['type'=>'blue'])
                <p class="text-sm ">{{$comment->content}}</p>
                <p class="text-sm">{{$comment->created_at->diffForHumans()}}</p>
            @endcomponent
        @empty
        <p class="text-red-500">no comment yet</p>
        @endforelse
    </div>
    <div class="flex justify-end">
        <a href="{{route('blogs.index')}}" class="py-1 px-3 bg-blue-500 text-white rounded">Back</a>
    </div>
</div>
@endsection
