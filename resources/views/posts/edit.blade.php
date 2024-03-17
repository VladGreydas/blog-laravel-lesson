<x-layouts.main>
    <section>
        <div class="container">
            <div class="section-title">
                <h3>Create Post</h3>
            </div>
            <div class="text-container fl-wrap">
                <!-- contact form -->
                <div class="contact-form-holder fl-wrap">
                    <div id="contact-form">
                        <div id="message"></div>
                        <form method="post" action="{{ route('posts.update', compact('post')) }}">
                            @csrf
                            @method('PUT')
                            <x-category-select :id="$post->category_id" />
                            <x-tag-select />

                            <x-blog.input :post="$post" />
                            <button type="submit"  id="submit"  data-top-bottom="transform: translateY(-50px);" data-bottom-top="transform: translateY(50px);"><span>Save </span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
