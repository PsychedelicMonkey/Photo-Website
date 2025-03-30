@props([
    "albums",
])

@if (count($albums) > 0)
    <div class="space-y-5">
        @foreach ($albums as $album)
            <div class="overflow-hidden px-3 md:px-5">
                <div class="border border-dashed border-black">
                    <div class="grid h-full grid-cols-1 items-center gap-4 md:grid-cols-2">
                        <div class="text-center p-2 md:p-4">
                            <a
                                href="{{ route("album.show", $album) }}"
                                class="inline-block font-serif text-6xl text-gray-900 duration-200 hover:text-purple-700 lg:text-9xl"
                            >
                                {{ $album->title }}
                            </a>
                        </div>

                        <figure class="aspect-h-1 aspect-w-1">
                            <img
                                src="{{ $album->getFirstMediaUrl("album-photos") }}"
                                alt=""
                                class="object-cover"
                            />
                        </figure>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $albums->links() }}
    </div>
@else
    <div>
        <h3>{{ __("No albums found") }}</h3>
    </div>
@endif
