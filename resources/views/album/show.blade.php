<x-app-layout>
    <div class="p-4">
        <header class="border border-dotted border-black">
                <div class="px-4 py-5 md:px-8">
                    <div class="space-y-4 text-center">
                        <h1 class="font-serif text-6xl font-semibold text-gray-900">
                            {{ $album->title }}
                        </h1>

                        <div class="flex flex-col justify-center gap-3 md:flex-row">
                            @isset($album->shooting_date)
                                <h3>
                                    {{ __("Shooting Date: :date", ["date" => $album->getShootingDate()]) }}
                                </h3>
                            @endisset

                            <h3>
                                {{ __("Published: :date", ["date" => $album->getUploadedDate()]) }}
                            </h3>
                        </div>

                        {{-- TODO: add model and location --}}

                        <x-tags :tags="$album->tags" />
                    </div>

                    @isset($album->description)
                        <article class="prose mt-8 max-w-none">
                            {!! $album->description !!}
                        </article>
                    @endisset
                </div>
            </header>
    </div>

    @if (count($album->media) > 0)
        <div class="masonry-grid" id="gallery">
            <div class="grid-sizer"></div>
            @foreach ($album->getMedia("album-photos") as $photo)
                @php
                    $size = getimagesize($photo->getUrl());
                @endphp

                <a
                    href="{{ $photo->getUrl() }}"
                    data-pswp-width="{{ $size[0] }}"
                    data-pswp-height="{{ $size[1] }}"
                    class="grid-item duration-150 hover:opacity-50"
                >
                    {{ $photo }}
                </a>
            @endforeach
        </div>
    @endif
</x-app-layout>
