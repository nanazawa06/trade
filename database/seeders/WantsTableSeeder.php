<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Want;
use Illuminate\Support\Facades\DB;

class WantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Want::factory()->count(10)->create();
        $wants = [
            [
                'post_id' => '1',
                'item_id' => '1',
            ],
            [
                'post_id' => '1',
                'item_id' => '2',
            ],
            [
                'post_id' => '2',
                'item_id' => '4',
            ],
            [
                'post_id' => '2',
                'item_id' => '8',
            ],
            [
                'post_id' => '3',
                'item_id' => '4',
            ],
            [
                'post_id' => '3',
                'item_id' => '5',
            ],
            [
                'post_id' => '4',
                'item_id' => '9',
            ],
            [
                'post_id' => '4',
                'item_id' => '8',
            ],
            [
                'post_id' => '4',
                'item_id' => '7',
            ],
            
        ];

        foreach ($wants as $want) {
            DB::table('wants')->insert($want);
        }
    }
}
