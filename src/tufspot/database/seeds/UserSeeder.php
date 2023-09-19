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
                'name' => 'test',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('testtest'),
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'hoge',
                'email' => 'hoge@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('hogehoge'),
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
