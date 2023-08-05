<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Give;
use Illuminate\Support\Facades\DB;

class GivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Give::factory()->count(10)->create();
        $gives = [
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

        foreach ($gives as $give) {
            DB::table('gives')->insert($give);
        }
    }
    
}
