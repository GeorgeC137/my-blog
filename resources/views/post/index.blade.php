<x-app-layout :meta-title="'Jijos Blog - Posts By Category ' . $category->title" meta-description="Jijo's first blog project">
    <div class="container mx-auto flex flex-wrap py-6">
        <section class="w-full md:w-2/3 px-3">
            <div class=" flex flex-col items-center">
                @foreach ($posts as $post)
                    <x-post-item :post="$post" />
                @endforeach
            </div>

            <!-- Pagination -->
            {{ $posts->links() }}

        </section>

        <!-- Sidebar Section -->
        <x-side-bar />
    </div>
</x-app-layout>
