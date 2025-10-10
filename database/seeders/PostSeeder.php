<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs to associate posts with users
        $userIds = User::pluck('id')->toArray();

        // Create 20 dummy posts
        for ($i = 1; $i <= 20; $i++) {
            Post::updateOrCreate(
                [
                    'title' => 'Sample Post ' . $i,
                ],
                [
                    'user_id' => $userIds[array_rand($userIds)], // Random user for each post
                    'content' => 'This is a sample content for post number ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'image' => 'sample_image_' . $i . '.jpg',
                    'published_at' => now()->subDays(random_int(0, 30)), // Published within last 30 days
                    'is_active' => true, // All posts are active
                    'created_at' => now()->subDays(random_int(0, 30)),
                    'updated_at' => now(),
                ]
            );
        }
    }
}