<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('admin'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'テスト太郎',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => '鈴木一郎',
                'email' => 'ichiro@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => '大坂なおみ',
                'email' => 'naomi@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}