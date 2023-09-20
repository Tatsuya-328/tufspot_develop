<?php

use Illuminate\Database\Seeder;
use Database\Seeds\UserSeeder;
use Database\Seeds\PostSeeder;
use Database\Seeds\TagSeeder;
use Database\Seeds\SnsAccountSeeder;
use Database\Seeds\GaigokaiAccountSeeder;
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
        $this->call(GaigokaiAccountSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SnsAccountSeeder::class);    
    }
}
