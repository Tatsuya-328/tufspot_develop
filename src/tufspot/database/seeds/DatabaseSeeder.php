<?php

use Illuminate\Database\Seeder;
use Database\Seeds\UserSeeder;
use Database\Seeds\PostSeeder;
use Database\Seeds\TagSeeder;
use Database\Seeds\SnsAccountSeeder;
use Database\Seeds\GaigokaiMemberSeeder;
use Database\Seeds\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SnsAccountSeeder::class);    
        $this->call(GaigokaiMemberSeeder::class);
    }
}
