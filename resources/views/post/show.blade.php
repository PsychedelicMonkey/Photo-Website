<x-app-layout>
    <div class="mx-auto max-w-7xl p-4 lg:p-6">
        <header class="my-6">
            <figure class="aspect-h-2 aspect-w-3">
                {{ $post->getImage() }}
            </figure>

            <div class="mt-4">
                <h1 class="text-5xl font-bold text-gray-900">{{ $post->title }}</h1>

                <div class="mt-6 flex flex-col items-baseline md:flex-row md:gap-4">
                    <h3>{{ $post->author->name }}</h3>
                    <h3>{{ $post->category->name }}</h3>
                    <h3>{{ $post->published_at->format("F jS, Y") }}</h3>
                </div>

                @if (count($post->tags) > 0)
                    <div class="mt-3 flex flex-wrap gap-1">
                        @foreach ($post->tags as $tag)
                            <a
                                href="#"
                                class="rounded-lg border border-gray-300 bg-gray-300 px-3 py-1 text-xs duration-200 hover:bg-transparent hover:text-gray-500"
                            >
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </header>

        <article class="prose">
            {!! $post->content !!}
        </article>

        {{-- TODO: About the author --}}
    </div>
</x-app-layout>
