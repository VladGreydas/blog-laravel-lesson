<x-layouts.main>
    @foreach($posts as $post)
        @forelse($posts as $post)
            <x-blog.post :post="$post" />
            @endforeach
        @empty
            <h2>404 NOT FOUND</h2>
        @endforelse

        {{ $posts->links() }}
</x-layouts.main>
