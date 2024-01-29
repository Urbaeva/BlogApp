@extends('layouts.main')
@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <span class="text-muted float-right">{{ $date->diffForHumans() }}</span>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">
                Created by {{ auth()->user()->name }} <br/>
               {{ $date->format('F') }} {{ $date->day }}, {{ $date->year }} • {{$date->format('H:i')}}
            </p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-tag">
                <p class="post-tags">
                    Tags:
                    @foreach($post->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->title }}</span>
                    @endforeach
                </p>
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <p>{{ strip_tags($post->content) }}</p>
                    </div>
                </div>
            </section>

            @can('edit', [$post, auth()->user()])
                <div class="row">
                    <a href="{{ route('personal.post.edit', $post->id) }}" class="text-success"
                       style="display: inline-block;">
                        <i class="fas fa-pencil-alt" style="display: inline-block; margin-right: 5px;"></i>
                        <span style="display: inline-block;"><h5>Edit</h5></span>
                    </a>
                </div>
            @endcan
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    @if($relatedPosts->count() > 0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                            <div class="row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <img src="{{ asset('storage/' . $relatedPost->image) }}" alt="related post"
                                             class="post-thumbnail">
                                        <p class="post-tags">
                                            Tags:
                                            @foreach($relatedPost->tags as $tag)
                                                <span class="badge badge-primary">{{ $tag->title }}</span>
                                            @endforeach
                                        </p>
                                        <a href="{{ route('blog.show', $relatedPost->id) }}"><h5
                                                class="post-title">{{ $relatedPost->title }}</h5></a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </main>

@endsection
