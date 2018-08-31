<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
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
                'name' => 'Test',
                'email' => 'test.user@gmail.com',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Test2',
                'email' => 'test2.user@gmail.com',
                'password' => Hash::make('123456')
            ],
        ];

        DB::table('users')->insert($users);
    }
}
