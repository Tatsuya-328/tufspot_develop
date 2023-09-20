<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GaigokaiAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('gaigokai_accounts')->insert([
            [
                'member_id' => $faker -> randomNumber(6, true),
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'member_id' => $faker -> randomNumber(6, true),
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'member_id' => $faker -> randomNumber(6, true),
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'member_id' => $faker -> randomNumber(6, true),
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],[
                'member_id' => $faker -> randomNumber(6, true),
                'phone_number' => '080' . $faker -> randomNumber(8, true),
            ],
            [
                // 新規登録用
                'member_id' => 111111,
                'phone_number' => '08011111111',
            ],[
                'member_id' => 222222,
                'phone_number' => '08022222222',
            ],[
                'member_id' => 333333,
                'phone_number' => '08033333333',
            ],[
                'member_id' => 444444,
                'phone_number' => '08044444444',
            ],[
                'member_id' => 555555,
                'phone_number' => '08055555555',
            ],
        ]);
    }
}
