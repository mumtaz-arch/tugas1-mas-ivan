@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Latest Posts</h1>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('home') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Search posts by title or content..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-secondary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($post->image)
                        <img src="{{ asset('postsimage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text flex-grow-1">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                        
                        <div class="mt-auto">
                            <p class="card-text">
                                <small class="text-muted">
                                    By {{ $post->user->name }} | {{ $post->published_at->format('F j, Y') }}
                                </small>
                            </p>
                            <a href="{{ route('public.posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No published posts found.</p>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection