<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'published_at',  // Changed to match existing database column
        'is_active',     // Changed to match existing database column
    ];

    protected $casts = [
        'published_at' => 'date',  // Changed to match existing database column
        'is_active' => 'boolean',  // Changed to match existing database column
    ];

    // Map the old column names to the new ones for compatibility
    public function getPublishDateAttribute()
    {
        return $this->published_at;
    }

    public function setPublishDateAttribute($value)
    {
        $this->published_at = $value;
    }

    public function getIsPublishAttribute()
    {
        return $this->is_active;
    }

    public function setIsPublishAttribute($value)
    {
        $this->is_active = $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}