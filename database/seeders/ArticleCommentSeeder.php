<?php

namespace Database\Seeders;

use App\Models\ArticleComment;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleComment::factory(200)->create();
    }
}
