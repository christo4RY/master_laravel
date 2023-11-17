@if($errors->any())
    <div class="mt-2 mb-2">
        @foreach($errors->all() as $error)
            <div class="py-1 px-3 bg-red-400 text-white " role="alert">
                {{ $error }}
            </div>
        @endforeach
    </div>
@endif
