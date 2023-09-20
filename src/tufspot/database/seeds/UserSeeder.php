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
                'gaigokai_id' => 1,
                'name' => 'スーパーユーザー',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('admin'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'gaigokai_id' => 2,
                'name' => '管理者テスト',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'gaigokai_id' => 3,
                'name' => '管理者太郎',
                'email' => 'taro@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'gaigokai_id' => 4,
                'name' => '読者一郎',
                'email' => 'ichiro@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'introduction' => $faker->realText(rand(100,200)),
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'gaigokai_id' => 5,
                'name' => '読者花子',
                'email' => 'hanako@example.com',
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
