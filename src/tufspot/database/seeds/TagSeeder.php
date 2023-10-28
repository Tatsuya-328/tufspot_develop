<?php

namespace Database\Seeds;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->insert([
            [
                'name' => 'お知らせ',
                'slug' => 'news',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'リリース',
                'slug' => 'release',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'キャンペーン',
                'slug' => 'campaign',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        foreach (Post::take(100)->get() as $post) {
            \DB::table('post_tag')->insert([
                'post_id' => $post->id,
                'tag_id' => fake()->numberBetween(1, 3)
            ]);
        }
    }
}
