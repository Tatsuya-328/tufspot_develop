<?php

namespace Database\Seeds;

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
                'name' => 'アジア特集',
                'slug' => 'asia',
                'description' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '大阪万博',
                'slug' => 'osaka-expo',
                'description' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '外語祭関連',
                'slug' => 'gaigosai',
                'description' => $faker->realText(rand(100, 200)),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        for ($i = 1; $i <= 50; $i++) {
            \DB::table('feature_post')->insert([
                'post_id' => $i,
                'feature_id' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
