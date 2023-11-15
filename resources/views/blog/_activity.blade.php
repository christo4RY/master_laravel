    @component('components.card', [
        'title' => 'Most Commented',
        'content' => 'What people are currently talking about',
    ])
        @foreach ($mostCommentedBlogs as $blog)
            <li class="border-b p-3 text-blue-500  font-bold"><a
                    href="{{ route('blogs.show', ['blog' => $blog->id]) }}">{{ $blog->title }}</a></li>
        @endforeach
    @endcomponent
    @component('components.card', ['title' => 'Most Active', 'content' => 'Users with most post written'])
        @foreach ($authors as $author)
            <li class="border-b p-3 text-gray-500 font-bold">{{ $author->name }}</li>
        @endforeach
    @endcomponent
    @component('components.card', ['title' => 'Most Active Last Month', 'content' => 'Users with most post written'])
        @foreach ($lastMonthBlog as $author)
            <li class="border-b p-3 text-gray-500 font-bold">{{ $author->name }}</li>
        @endforeach
    @endcomponent
