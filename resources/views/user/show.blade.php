@extends('layout.app')

@section('title', $user->name)

@section('content')
    <div class="flex space-x-12 justify-center  w-full my-10">
        <img src="{{ $user->image?->url() }}" class=" w-56 h-56" alt="">
      <div>
        <div class="my-3">
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        </div class="my-5">
            @auth
                @include('comment._form', ['route' => route('user-comment.store', ['user' => $user->id])])
            @else
                <h3><a href="{{ route('login') }}" class=" underline text-blue-500">Sign in</a> Please Login </h3>
            @endauth
        </div>
        @include('comment.show',['comments'=>$user->commentsOn])
      </div>
    @endsection
