<div class="flex flex-col gap-2">
    <label for="title" class=" uppercase text-slate-500">Title</label>
    <input name="title" type="text" id="title" value="{{ old('title', optional($blog ?? null)->title) }}"
        class="border-0 border-b-2 bg-slate-50 rounded focus:ring-0 focus:border-b-2 p-1 focus:outline-0">
    @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
<div class="flex flex-col gap-2">
    <label for="content" class=" uppercase text-slate-500">Content</label>
    <input name="content" type="text" id="content" value="{{ old('content', optional($blog ?? null)->content) }}"
        class="border-0 border-b-2 bg-slate-50 rounded focus:ring-0 focus:border-b-2 p-1 focus:outline-0">
    @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
@if ($blog->image?->thumnail)
    <img src="{{$blog->image->url()}}" class=" w-52 h-32 object-cover" alt="">
@endif
<div class="flex flex-col gap-2">
    <label for="file" class=" uppercase text-slate-500">Thumnail</label>
    <input name="file" type="file" id="file" value="{{ old('file', optional($blog ?? null)->image?->thumnail) }}"
        class="border-0 border-b-2 bg-slate-50 rounded focus:ring-0 focus:border-b-2 p-1 focus:outline-0">
    @error('file')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
@error('error')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
<button type="submit" class="bg-green-500 rounded py-1 px-4 text-white w-full text-base md:text-lg">Save</button>
