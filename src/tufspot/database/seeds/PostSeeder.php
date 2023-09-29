<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Event::fakeFor(function () {
            Post::factory()->count(100)->create();
        });

        \DB::table('likes')->insert([
            [
                'user_id' => 2,
                'post_id' => 1,
            ],
            [
                'user_id' => 2,
                'post_id' => 2,
            ],
            [
                'user_id' => 2,
                'post_id' => 3,
            ],
            [
                'user_id' => 2,
                'post_id' => 4,
            ],
            [
                'user_id' => 2,
                'post_id' => 5,
            ],
        ]);
    }
}
