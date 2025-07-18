<?php

namespace Database\Seeders;

use App\Modules\Blog\Domain\Entities\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::truncate(); // Xóa sạch trước khi seed (tuỳ nhu cầu)

        $blogs = [
            [
                'title' => 'Why I Love Laravel',
                'slug' => Str::slug('Why I Love Laravel'),
                'content' => '<p>Laravel makes development joyful with elegant syntax.</p>',
                'status' => 'published',
                'thumbnail' => 'https://via.placeholder.com/600x400',
                'published_at' => now(),
            ],
            [
                'title' => 'Building a Portfolio with Laravel + React',
                'slug' => Str::slug('Building a Portfolio with Laravel + React'),
                'content' => '<p>Learn how to build a CMS-style portfolio site using Laravel API and ReactJS frontend.</p>',
                'status' => 'draft',
                'thumbnail' => 'https://via.placeholder.com/600x400',
                'published_at' => null,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog + [
                    'created_by' => 1,
                    'updated_by' => 1,
            ]);
        }
    }
}
