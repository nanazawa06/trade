<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Item;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Post::factory()->count(4)->create();
        for ($i=1; $i < 10; $i++){
        $post = \App\Models\Post::factory()
            ->withItems()
            ->create();
        }
    }
}
