<?php

namespace Database\Seeders;

use App\Models\NewsLikes;
use Illuminate\Database\Seeder;

class NewsLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsLikes::factory()->count(100)->create();
    }
}
