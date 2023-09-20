<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SnsAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('sns_accounts')->insert([
            [
                'user_id' => 2,
                'name' => 'X(Twitter)',
                'url' => 'https://x.com/'
            ],[
                'user_id' => 2,
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com/'
            ],[
                'user_id' => 2,
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/'
            ],            [
                'user_id' => 3,
                'name' => 'X(Twitter)',
                'url' => 'https://x.com/'
            ],[
                'user_id' => 3,
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com/'
            ],[
                'user_id' => 3,
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/'
            ]
        ]);
    }
}
