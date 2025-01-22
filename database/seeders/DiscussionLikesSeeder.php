<?php

namespace Database\Seeders;

use App\Models\DiscussionLikes;
use Illuminate\Database\Seeder;

class DiscussionLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiscussionLikes::factory()->count(100)->create();
    }
}
