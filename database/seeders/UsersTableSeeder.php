<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'testuser1',
                'email' => 'testuser1@example.com',
                'password' => Hash::make('password1'),
                'area_id' => '5',
            ],
            [
                'name' => 'testuser2',
                'email' => 'testuser2@example.com',
                'password' => Hash::make('password2'),
                'area_id' => '4',
            ],
            [
                'name' => 'nana',
                'email' => 'nana@example.com',
                'password' => Hash::make('password3'),
                'area_id' => '10',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
