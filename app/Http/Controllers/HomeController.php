<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Post::with('user');
        
        // Dynamically check for published status column
        if (Schema::hasColumn('posts', 'is_active')) {
            $query->where('is_active', true);
        } elseif (Schema::hasColumn('posts', 'is_publish')) {
            $query->where('is_publish', true);
        } else {
            // If neither column exists, let's try to query without this condition for now
            // This is a temporary solution until the database schema is properly updated
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }
        
        // Use published_at if it exists, otherwise use created_at as fallback
        $orderByColumn = Schema::hasColumn('posts', 'published_at') ? 'published_at' : 'created_at';
        $posts = $query->orderBy($orderByColumn, 'desc')->paginate(6);
        
        return view('home.index', compact('posts', 'search'));
    }
}