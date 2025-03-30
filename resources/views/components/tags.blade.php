@props([
    "tags",
])

@if (count($tags) > 0)
    <div class="flex flex-wrap justify-center gap-2">
        @foreach ($tags as $tag)
            <a
                {{-- TODO: Add tag link --}}
                href="#"
                class="rounded-md border border-purple-400 bg-purple-400 px-3 py-1 text-sm text-gray-900 duration-200 hover:border-purple-600 hover:bg-transparent hover:text-purple-600"
            >
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
@endif
