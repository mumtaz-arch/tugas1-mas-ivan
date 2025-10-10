@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">← Back to Users</a>
            
            <div class="card">
                <div class="card-body text-center">
                    @if($user->photo)
                        <img src="{{ asset('photos/' . $user->photo) }}" alt="User Photo" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                            <span class="text-white">No Photo</span>
                        </div>
                    @endif
                    
                    <h1 class="card-title">{{ $user->name }}</h1>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <p class="card-text">
                                <strong>Username:</strong><br>
                                {{ $user->username }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text">
                                <strong>Email:</strong><br>
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <p class="card-text">
                            <strong>Role:</strong><br>
                            @if($user->role === 1)
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection