<x-app-layout>
    <div class="mx-auto max-w-7xl p-4 lg:p-6">
        <h1 class="text-3xl font-semibold text-gray-900">{{ __("Posts") }}</h1>

        {{-- TODO: Style cards --}}
        @if (count($posts) > 0)
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <div class="border border-dashed bg-white">
                        <figure class="aspect-h-2 aspect-w-3">
                            {{ $post->getImage() }}
                        </figure>

                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $post->title }}</h3>

                            <article>
                                {{ $post->getShortBody() }}
                            </article>

                            <a href="{{ route("post.show", $post) }}">{{ __("Read") }}</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
