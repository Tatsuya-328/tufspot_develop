<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GaigokaiMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('gaigokai_members')->insert([
            [
                // テスト用に既存ユーザー追加
                'id' => '000001',
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'id' => '000002',
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'id' => '000003',
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'id' => '000004',
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'id' => '000005',
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],
            [
                // 新規登録用 
                'id' => '000006',
                'phone_number' => '08011111111',
            ],[
                'id' => '000007',
                'phone_number' => '08022222222',
            ],[
                'id' => '000008',
                'phone_number' => '08033333333',
            ],[
                'id' => '000009',
                'phone_number' => '08044444444',
            ],[
                'id' => 'abcd10',
                'phone_number' => '08055555555',
            ],
        ]);

        // テスト用に既存ユーザーに追加
        for ($i = 1; $i <= 5; $i++) {
            \DB::table('gaigokai_member_user')->insert([
                'gaigokai_member_id' => '00000'.$i,
                'user_id' => $i
            ]);
        }
    }
}
