<?php

namespace Database\Seeds;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('features')->insert([
            [
                'name' => '注目記事',
                'slug' => 'pickup',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'アジア特集',
                'slug' => 'asia',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '大阪万博',
                'slug' => 'osaka-expo',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '外語祭関連',
                'slug' => 'gaigosai',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        foreach (Post::take(100)->get() as $post) {
            \DB::table('feature_post')->insert([
                'post_id' => $post->id,
                'feature_id' => $faker->numberBetween(1, 4)
            ]);
        }
    }
}
