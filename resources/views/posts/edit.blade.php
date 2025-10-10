@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <h2>Edit Post</h2>

    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            <div class="form-text">Format: jpeg, png, jpg, gif | Max: 2MB</div>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            @if($post->image)
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="{{ asset('posts/' . $post->image) }}" alt="Current Image" width="200">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Publish Date & Time</label>
            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\\TH:i') : '') }}" required>
            @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Post Status</label>
            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active" required>
                <option value="1" {{ old('is_active', $post->is_active) == 1 ? 'selected' : '' }}>Published</option>
                <option value="0" {{ old('is_active', $post->is_active) == 0 ? 'selected' : '' }}>Draft</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection