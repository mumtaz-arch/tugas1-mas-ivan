@extends('layouts.app')

@section('title', 'Public Posts')

@section('content')
<div class="container mt-4">
    <h2>Public Posts</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ route('public.posts.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    @if($search)
        <p class="mb-3">Search results for: <strong>{{ $search }}</strong> ({{ $posts->total() }} results)</p>
    @endif

    @if($posts->count() > 0)
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($post->image)
                            <img src="{{ asset('postsimage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <div class="mt-auto">
                                <small class="text-muted">
                                    Published: {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }} 
                                    by {{ $post->user->name ?? 'Unknown' }}
                                </small>
                                <a href="{{ route('public.posts.show', $post) }}" class="btn btn-primary btn-sm mt-2">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $posts->appends(['search' => request('search')])->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No posts found.
        </div>
    @endif
</div>
@endsection