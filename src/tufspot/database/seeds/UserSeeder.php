<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('admin'),
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'テスト太郎',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => '鈴木一郎',
                'email' => 'ichiro@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => '大坂なおみ',
                'email' => 'naomi@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
