<x-app-layout>
    <div class="mx-auto max-w-7xl p-4 lg:p-6">
        <header class="my-6">
            <figure class="aspect-h-2 aspect-w-3">
                {{ $post->getImage() }}
            </figure>

            <div class="mt-4">
                <h1 class="text-5xl font-bold text-gray-900">{{ $post->title }}</h1>

                <div class="mt-6 flex items-baseline md:gap-4 flex-col md:flex-row">
                    <h3>{{ $post->author->name }}</h3>
                    <h3>{{ $post->category->name }}</h3>
                    <h3>{{ $post->published_at->format('F jS, Y') }}</h3>
                </div>

                @if(count($post->tags) > 0)
                    <div class="mt-3 flex-wrap flex gap-1">
                        @foreach($post->tags as $tag)
                            <a href="#"
                               class="bg-gray-300 px-3 py-1 rounded-lg text-xs hover:bg-transparent border border-gray-300 hover:text-gray-500 duration-200">{{ $tag->name }}</a>
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
