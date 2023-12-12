@extends('layout.app')

@section('title', $user->name)

@section('content')
    <div class="flex space-x-12  w-full my-10">
        <div class="w-[40%] flex flex-col items-end justify-end">
            @if (session()->get('status'))
            <p class="text-green-500">{{session()->get('status')}}</p>
            @endif
            <img src="{{ $user->image?->url() }}" class=" w-56 h-56" alt="">
        </div>
        <div class="w-[40%] px-28">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex space-y-2 flex-col my-3">
                    <label for="name">Name</label>
                    <input type="text" value="{{ old('name', optional($user)->name) }}" name="name" class=" rounded " id="name" />
                    @error('name')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex space-y-2 flex-col my-3">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class=" rounded " id="avatar" />
                    @error('avatar')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex space-y-2 flex-col my-3">
                    <label for="local">Language</label>
                    <select name="local" id="local">
                        <option value="en" {{$user->local == "en" ? 'selected' : ''}}>English</option>
                        <option value="es" {{$user->local == "es" ? 'selected' : ''}}>Spaich</option>
                    </select>
                    @error('local')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <button class="py-0.5 xl:py-1 px-2 xl:px-3 bg-green-400 rounded">Save</button>
            </form>
        </div>
    </div>
@endsection
