<form action="{{ route('comment.store', ['blog' => $blog->id]) }}" method="POST">
    @csrf
    <div class="flex space-y-2 flex-col my-3">
        <label for="comment">Comment</label>
        <textarea name="comment" class=" rounded " id="comment"></textarea>
    </div>
    <div class="my-3">
        @include('components.error')
    </div>
    <button class="py-0.5 xl:py-1 px-2 xl:px-3 bg-green-400 rounded">Save</button>

</form>
