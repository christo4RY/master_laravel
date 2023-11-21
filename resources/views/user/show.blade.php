@extends('layout.app')

@section('title', $user->name)

@section('content')
    <div class="flex space-x-12 justify-center  w-full my-10">
        <img src="{{ $user->image?->url() }}" class=" w-56 h-56" alt="">
        <div class="my-3">
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        </div>
    </div>
@endsection
