<?php

namespace Database\Seeders;

use App\Models\NewsArticle;
use Illuminate\Database\Seeder;

class NewsArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsArticle::factory(43)->create();
    }
}