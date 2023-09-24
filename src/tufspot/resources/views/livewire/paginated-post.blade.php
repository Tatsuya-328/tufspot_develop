<div>
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($posts as $post)
            <x-post_card :post=$post />
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
