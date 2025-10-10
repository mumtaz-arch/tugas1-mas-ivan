<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Schema;

class PublicPostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Get all published posts
        $query = Post::where(function($q) {
            if (Schema::hasColumn('posts', 'is_active')) {
                $q->where('is_active', true);
            } elseif (Schema::hasColumn('posts', 'is_publish')) {
                $q->where('is_publish', true);
            }
        })
        ->when(Schema::hasColumn('posts', 'published_at'), function($q) {
            $q->where('published_at', '<=', now()); // This already includes time precision
        });
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }
        
        $posts = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('posts.public_index', compact('posts', 'search'));
    }

    public function show(Post $post)
    {
        // Only allow viewing of published posts
        $isPublished = false;
        
        if (Schema::hasColumn('posts', 'is_active')) {
            $isPublished = $post->is_active;
        } elseif (Schema::hasColumn('posts', 'is_publish')) {
            $isPublished = $post->is_publish;
        } else {
            // If column doesn't exist, fallback to some default behavior
            $isPublished = true; // or false, depending on your default
        }
        
        if (!$isPublished) {
            abort(404);
        }
        
        return view('posts.public_show', compact('post'));
    }
}