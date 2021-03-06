<?php

use Illuminate\Database\Seeder;
use App\Post;
Use App\User;
Use App\Category;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $title = 'Proviamo se funziona lo slug';
        Post::create([
            'user_id'   => 1,
            'category_id' => 1,
            'title'     => $title,
            'content'   => $faker->text(rand(200, 1000)),
            'slug'      => Post::titleToSlug($title)
        ]);
        Post::create([
            'user_id'   => 2,
            'category_id' => 2,
            'title'     => $title,
            'content'   => $faker->text(rand(200, 1000)),
            'slug'      => Post::titleToSlug($title)
        ]);
        Post::create([
            'user_id'   => 3,
            'category_id' => 3,
            'title'     => $title,
            'content'   => $faker->text(rand(200, 1000)),
            'slug'      => Post::titleToSlug($title)
        ]);

        for ($i = 0; $i < 100; $i++) {
            $title = $faker->words(rand(2, 10), true);
            Post::create([
                'user_id'   => User::inRandomOrder()->first()->id, 
                'category_id' => Category::inRandomOrder()->first()->id,
                'title'     => $title,
                'content'   => $faker->text(rand(200, 1000)),
                'slug'      => Post::titleToSlug($title)
            ]);
        }
    }
}
