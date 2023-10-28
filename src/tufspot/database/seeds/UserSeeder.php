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
                'name' => 'スーパーユーザー',
                'tufspot_id' => 'super_user',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('admin'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '管理者テスト',
                'tufspot_id' => 'admin_test',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '管理者太郎',
                'tufspot_id' => 'admin_taro',
                'email' => 'taro@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '執筆テスト',
                'tufspot_id' => 'editor_test',
                'email' => 'writer@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 2,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用1',
                'tufspot_id' => 'test_1',
                'email' => 'test1@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用2',
                'tufspot_id' => 'test_2',
                'email' => 'test2@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用3',
                'tufspot_id' => 'test_3',
                'email' => 'test3@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用4',
                'tufspot_id' => 'test_4',
                'email' => 'test4@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用5',
                'tufspot_id' => 'test_5',
                'email' => 'test5@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用6',
                'tufspot_id' => 'test_6',
                'email' => 'test6@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用7',
                'tufspot_id' => 'test_7',
                'email' => 'test7@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'テスト用8',
                'tufspot_id' => 'test_8',
                'email' => 'test8@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 1,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '読者テスト',
                'tufspot_id' => 'reader_test',
                'email' => 'reader@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 3,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '読者花子',
                'tufspot_id' => 'reader_hanako',
                'email' => 'hanako@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 3,
                'introduction' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // フォローテーブルシーダー（test管理者のみ）
        for ($i = 3; $i <= 8; $i++) {
            \DB::table('follows')->insert([
                'user_id' => 2,
                'followed_user_id' => $i
            ]);
        }
    }
}
