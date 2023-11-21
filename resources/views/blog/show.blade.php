@extends('layout.app')

@section('title', $blog->title)

@section('content')
    <div class="w-full flex space-x-5">
        <div class="w-[70%] space-y-5  mx-auto p-4 border shadow-lg rounded">
            <div class="mb-2">
                @if ($blog->image)
                    <img src="{{  $blog->image->url() }}" class=" w-64 h-48"
                        alt=">
                @endif
                    <h1 class="text-2xl object-cover rounded">{{ $blog->title }}</h1>
            </div>
            <p class="text-lg">{{ $blog->content }}</p>
            <div>
                {{ $counter }} Views
            </div>
            @component('components.tags', ['tags' => $blog->tags])
            @endcomponent
            <div>
                <h4 class="text-xl">Comments</h4>
                @auth
                    @include('comment._form', ['blog' => $blog])
                @else
                    <h3><a href="{{ route('login') }}" class=" underline text-blue-500">Sign in</a> Please Login </h3>
                @endauth
                @forelse ($blog->comments as $comment)
                    @component('components.comment', ['type' => 'blue'])
                        <p class="text-sm ">{{ $comment->content }}</p>
                        <p class="text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    @endcomponent
                @empty
                    <p class="text-red-500">no comment yet</p>
                @endforelse
            </div>
            <div class="flex justify-end">
                <a href="{{ route('blogs.index') }}" class="py-1 px-3 bg-blue-500 text-white rounded">Back</a>
            </div>
        </div>
        <div class="w-[30%]">
            @include('blog._activity')
        </div>
    </div>
@endsection
