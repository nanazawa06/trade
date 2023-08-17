<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition()
    {
        return [
            'description' => fake()->word,
            'status' => 'trading',
            'user_id' => rand(1, 2),
            'state_id' => rand(1, 5),
        ];
    }
    public function withItems()
    {
        return $this->afterCreating(function (Post $post) {
            $wantItems = \App\Models\Item::factory()->count(2)->create(); // create 3 items for ‘wants’
            $post->wants()->attach($wantItems);
            $giveItems = \App\Models\Item::factory()->count(2)->create(); // create 3 items for ‘gives’
            $post->gives()->attach($giveItems);
        });
    }

}
