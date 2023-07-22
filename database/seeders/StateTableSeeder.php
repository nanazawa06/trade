<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $states = [
            '新品・未使用','未使用に近い', '目立った傷や汚れなし',
            'やや傷や汚れあり', '傷や汚れあり', '全体的に状態が悪い'
        ];

        foreach ($states as $state) {
            DB::table('states')->insert([
                'state' => $state,
            ]);
        }
    }
}
