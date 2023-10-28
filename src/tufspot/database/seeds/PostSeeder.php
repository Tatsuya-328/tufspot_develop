<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

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

        $seedingUser = User::find(2);
        foreach (Post::take(5)->get() as $post) {
            $seedingUser->likes()->attach($post->id);
        }
    }
}
