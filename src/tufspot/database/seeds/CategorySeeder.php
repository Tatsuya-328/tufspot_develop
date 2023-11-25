<?php

namespace Database\Seeds;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('categories')->insert([
            [
                'name' => 'Academia',
                'slug' => 'academia',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Business and Career',
                'slug' => 'business-and-career',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Culture and Essay',
                'slug' => 'culture-and-essay',
                'description' => $faker->realText(rand(100, 200)),
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        foreach (Post::take(100)->get() as $post) {
            \DB::table('category_post')->insert([
                'post_id' => $post->id,
                'category_id' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
