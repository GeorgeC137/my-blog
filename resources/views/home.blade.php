<x-app-layout meta-description="Jijo's first blog project">
    <div classs="container mx-auto max-w-4xl py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            {{-- Latest Post --}}
            <div class="col-span-2">
                <h2 class="uppercase font-bold text-blue-500 border-blue-500 text-lg sm:text-xl mb-3 border-b-2 pb-1">
                    Latest Posts
                </h2>

                @if ($latestPost)
                    <x-post-item :post="$latestPost" />
                @endif

            </div>

            {{-- Popular 3 posts --}}
            <div>
                <h2 class="uppercase font-bold text-blue-500 border-blue-500 text-lg sm:text-xl mb-3 border-b-2 pb-1">
                    Popular Posts
                </h2>

                @foreach ($popularPosts as $post)
                    <div class="grid grid-cols-4 gap-2 mb-4">
                        <a href="{{ route('view', $post) }}" class="pt-1">
                            <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}" />
                        </a>
                        <div class="col-span-3">
                            <a href="{{ route('view', $post) }}">
                                <h3 class="text-sm whitespace-nowrap truncate uppercase">{{ $post->title }}</h3>
                            </a>
                            <div class="flex gap-4 mb-2">
                                @if ($post->categories)
                                    @foreach ($post->categories as $category)
                                        <a href="#"
                                            class="text-white bg-blue-500 p-1 rounded text-xs font-bold uppercase pb-4">{{ $category->title }}</a>
                                    @endforeach
                                @endif
                            </div>

                            <div class="text-xs">
                                {{ $post->shortBody(10) }}
                            </div>

                            <a href="{{ route('view', $post) }}"
                                class="uppercase text-xs text-gray-800 hover:text-black">Continue Reading <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recommended posts  --}}
    <div class="mb-8">
        <h2 class="uppercase font-bold text-blue-500 border-blue-500 text-lg sm:text-xl mb-3 border-b-2 pb-1">
            Recommended Posts
        </h2>

        <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
            @foreach ($recommendedPosts as $post)
                <x-post-item :post="$post" :show-author="false" />
            @endforeach
        </div>
    </div>

    {{-- Latest Categories  --}}
    @foreach ($categories as $category)
        <div>
            <h2 class="uppercase font-bold text-blue-500 border-blue-500 text-lg sm:text-xl mb-3 border-b-2 pb-1">
                Category "{{ $category->title }}"
                <a href="{{ route('by-category', $category) }}">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </h2>


            <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach ($category->publishedPosts()->limit(3)->get() as $post)
                        <x-post-item :post="$post" :show-author="false" />
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
