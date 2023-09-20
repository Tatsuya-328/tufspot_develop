<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year', '-1day');
        $featured_image_array = [ '/image/ハロン湾.jpeg', '/image/スイティエン.jpeg','/image/アンコールワット.jpeg',];
        
        //「array_rand」関数を使ってランダムなキーを取得
        $randkey_1 = array_rand( $featured_image_array, 1 );

        return [
            'title' => $this->faker->realText(rand(20,50)),
            'featured_image_path' => $featured_image_array[$randkey_1],
            'description' =>$this->faker->realText(rand(100,200)),
            'body' => '<h1>大見出し</h1>' . $this->faker->realText(rand(200,300)) . "<p><br></p><h1>まとめ</h1>" . $this->faker->realText(rand(200,300)),
            'is_public' => $this->faker->boolean(90),
            'published_at' => $random_date,
            'user_id' => $this->faker->numberBetween(2,3),
            // 'user_id' => 1,
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
