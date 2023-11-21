@extends('layout.app')

@section('title','Blog Create')

@section('content')
<div class="mx-auto sm:w-[50%] w-full lg:w-[40%] p-7 border shadow-lg rounded">
    <div class="mb-5">
        <h1 class="text-2xl font-bold">CREATE BLOG</h1>
    </div>

    <div>
        <form action="{{route('blogs.store')}}" class=" space-y-5" method="POST" enctype="multipart/form-data">
            @csrf
            @include('components.blog-form')
        </form>
    </div>
</div>
@endsection
