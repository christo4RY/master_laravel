<div class="flex space-x-2 my-2 items-center">
    @foreach ($tags as $tag)
        <a href="{{ route('tag.index', ['tag' => $tag->id]) }}"
            class="py-0.5 text-sm px-2 rounded bg-green-400">{{ $tag->name }}</a>
    @endforeach
</div>
