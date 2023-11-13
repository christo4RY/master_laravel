@extends('layout.app')

@section('title',$blog->title)

@section('content')
<div class="mx-auto sm:w-[50%] w-full lg:w-[40%] p-7 border shadow-lg rounded">
    <div class="mb-5">
        <h1 class="text-2xl font-bold"> {{$blog->title}} Edit</h1>
    </div>

    <div>
        <form action="{{route('blogs.update',['blog'=>$blog->id])}}" class=" space-y-5" method="POST">
            @csrf
            @method('PATCH')
            @include('components.blog-form')
        </form>
    </div>
</div>
@endsection