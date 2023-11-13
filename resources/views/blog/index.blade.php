@extends('layout.app')

@section('title','Posts')

@section('content')
<div class="flex space-x-7">
    <div class="w-full md:w-[75%]">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Posts</h1>
            <a href="{{route('blogs.create')}}"
               class=" cursor-pointer hover:bg-green-300 transition-all duration-300 flex items-center gap-3 p-1  rounded bg-green-200 text-slate-500 px-2 shadow">
                <h5>Create</h5>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
        @if(Session::has('message'))
            <div @class([ 'mb-5 p-2 rounded text-white' ,Session::get('color')])>
                <h1>{{Session::get('message')}}</h1>
            </div>
        @endif
        <div class=" grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($blogs as $blog)
                @include('components.blog-card')
            @empty
                <div class=" p-3  rounded bg-red-300">
                    <h5>Not Found Blogs</h5>
                </div>
            @endforelse
        </div>
    </div>
    <div class="w-full md:w-[25%] space-y-7">

        @component('components.card',['title'=>'Most Commented','content'=>'What people are currently talking about'])
            @foreach($mostCommentedBlogs as $blog)
                <li class="border-b p-3 text-blue-500  font-bold"><a href="{{route('blogs.show',['blog'=>$blog->id])}}">{{$blog->title}}</a></li>
            @endforeach
        @endcomponent
        @component('components.card',['title'=>'Most Active','content'=>'Users with most post written'])
                @foreach($authors as $author)
                    <li class="border-b p-3 text-gray-500 font-bold">{{$author->name}}</li>
                @endforeach
        @endcomponent
            @component('components.card',['title'=>'Most Active Last Month','content'=>'Users with most post written'])
                @foreach($lastMonthBlog as $author)
                    <li class="border-b p-3 text-gray-500 font-bold">{{$author->name}}</li>
                @endforeach
            @endcomponent
    </div>
</div>
@endsection
