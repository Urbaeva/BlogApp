@extends('layouts.main')
@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
            <section class="featured-posts-section">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-left">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ 'storage/' . $post->image }}" alt="blog post">
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="blog-post-tags">
                                    @foreach($post->tags as $tag)
                                        <span class="badge badge-primary">{{ $tag->title }}</span>
                                    @endforeach
                                </p>
                                @auth()
                                    <form action="{{ route('post.like.store', $post->id) }}" method="POST">
                                        <span>{{ $post->liked_users_count }}</span>
                                        @csrf
                                        <button type="submit" class="border-0 bg-transparent">
                                            <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                                        </button>
                                    </form>
                                @endauth
                                @guest()
                                    <div>
                                        <span>{{ $post->liked_users_count }}</span>
                                        <i class="far fa-heart"></i>
                                    </div>
                                @endguest
                            </div>
                            @auth()
                                <a href="{{ route('blog.show', $post->id) }}" class="blog-post-permalink">
                                    <h6 class="blog-post-title">{{ $post->title }}</h6>
                                </a>
                            @endauth
                            @guest()
                                <a href="#" class="blog-post-permalink" onclick="showLoginAlert()">
                                    <h6 class="blog-post-title">{{ $post->title }}</h6>
                                </a>
                            @endguest
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="mx-auto" style="margin-top: -80px">
                        {{ $posts->links() }}
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <div class="row blog-post-row">
                            @foreach($randomPosts as $randomPost)
                                <div class="col-md-6 blog-post" data-aos="fade-up">
                                    <div class="blog-post-thumbnail-wrapper">
                                        <img src="{{ 'storage/' . $randomPost->image }}" alt="blog post">
                                    </div>
                                    <p class="blog-post-tags">
                                        Tags:
                                        @foreach($post->tags as $tag)
                                            <span class="badge badge-primary">{{ $tag->title }}</span>
                                        @endforeach
                                    </p>
                                    <a href="#!" class="blog-post-permalink">
                                        <h6 class="blog-post-title">{{ $randomPost->title }}</h6>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
                <div class="col-md-4 sidebar" data-aos="fade-left">
                    <div class="widget widget-post-list">
                        <h5 class="widget-title">Popular post List</h5>
                        <ul class="post-list">
                            @foreach($popularPosts as $popularPost)
                                @auth()
                                <li class="post">
                                    <a href="{{ route('blog.show', $post->id) }}" class="post-permalink media">
                                        <img src="{{ 'storage/' . $popularPost->image }}" alt="blog post">
                                        <div class="media-body">
                                            <h6 class="post-title">{{ $popularPost->title }}</h6>
                                        </div>
                                    </a>
                                </li>
                                @endauth
                                    @guest()
                                        <li class="post">
                                            <a href="#" class="post-permalink media" onclick="showLoginAlert()">
                                                <img src="{{ 'storage/' . $popularPost->image }}" alt="blog post">
                                                <div class="media-body">
                                                    <h6 class="post-title">{{ $popularPost->title }}</h6>
                                                </div>
                                            </a>
                                        </li>
                                    @endguest
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        function showLoginAlert() {
            // Show a simple alert asking the guest to log in
            alert("To see this post, please LOGIN or create an account.");
        }
    </script>
@endsection
