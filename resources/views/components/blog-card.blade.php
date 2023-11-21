<div class=" p-4 border shadow-lg flex flex-col rounded-lg hover:shadow transition-all duration-300">

    <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}" class="mb-3 underline text-blue-500 text-xl">
        @if ($blog->trashed())
            <del>
        @endif
        {{ $blog->title }}
        @if ($blog->trashed())
            </del>
        @endif
    </a>
    <h2 class="mb-3">{{ $blog->content }}</h2>
    @component('components.tags', ['tags' => $blog->tags])
    @endcomponent
    <h4 class="font-light">Added {{ $blog->created_at->diffForHumans() }} by <a href="{{ route('user.show',['user'=>$blog->author->id]) }}"
            class="font-bold text-blue-500 underline">{{ $blog->author->name }}</a></h4>
    <div class="flex mt-auto justify-between">
        <div>
            @if ($blog->comments_count)
                <p class="text-sm">{{ $blog->comments_count }} comments</p>
            @else
                <p class="text-sm">no comment yet</p>
            @endif
        </div>
        <div class="flex gap-3">
            @can('update', $blog)
                <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}"
                    class="py-1 px-3  rounded text-sm text-white hover:bg-yellow-600 transition-colors duration-300 bg-yellow-400">Edit</a>
            @endcan
            @can('delete', $blog)
                <form action="{{ route('blogs.destroy', ['blog' => $blog->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="py-1 px-3  rounded text-sm text-white hover:bg-red-600 transition-colors duration-300 bg-red-400">Delete</button>
                </form>
            @endcan
        </div>
    </div>
</div>
