<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Post::class);
        
        $search = $request->input('search');
        
        $query = Post::with('user');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }
        
        // Admin can view all posts, others can only view their own (policy handles this)
        if (auth()->user()->role !== 1) { // Not an admin
            $query->where('user_id', auth()->id());
        }
        
        // Use published_at if it exists, otherwise use created_at as fallback
        $orderByColumn = Schema::hasColumn('posts', 'published_at') ? 'published_at' : 'created_at';
        $posts = $query->orderBy($orderByColumn, 'desc')->paginate(10);
        
        return view('posts.index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'required|date',  // Changed to existing column name
            'is_active' => 'boolean'  // Changed to existing column name
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('postsimage'), $imageName);
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'published_at' => $request->published_at,  // Changed to existing column name
            'is_active' => $request->is_active ?? true,  // Changed to existing column name
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'required|date',  // Changed to existing column name
            'is_active' => 'boolean'  // Changed to existing column name
        ]);

        $imageName = $post->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                $oldImagePath = public_path('postsimage/'.$post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('postsimage'), $imageName);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'published_at' => $request->published_at,  // Changed to existing column name
            'is_active' => $request->is_active ?? true,  // Changed to existing column name
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        // Delete image file if exists
        if ($post->image) {
            $imagePath = public_path('postsimage/'.$post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}