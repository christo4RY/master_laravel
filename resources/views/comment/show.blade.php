@forelse ($comments as $comment)
@component('components.tags', ['tags' => $comment->tags ])
@endcomponent
<p class="text-sm ">{{ $comment->content }}</p>
<p class="text-sm">{{ $comment->created_at->diffForHumans() }}</p>
@empty
<p class="text-red-500">no comment yet</p>
@endforelse
