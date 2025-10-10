@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">← Back to Posts</a>
            
            <div class="card">
                @if($post->image)
                    <img src="{{ asset('posts/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    
                    <p class="text-muted">
                        By {{ $post->user->name }} | Published on {{ $post->published_at->format('F j, Y') }}
                    </p>
                    
                    <div class="mt-3">
                        <p class="card-text">{!! nl2br(e($post->content)) !!}</p>
                    </div>
                    
                    @if($post->is_active)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-warning">Draft</span>
                    @endif
                </div>
            </div>
            
            @if(auth()->check() && (auth()->user()->role === 1 || $post->user_id === auth()->id()))
                <div class="mt-3">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection