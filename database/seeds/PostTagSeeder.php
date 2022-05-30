<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        
        foreach ($posts as $post) {
            $postTags = Tag::inRandomOrder()->limit(rand(0, 5))->get();

            $arrPostTags = [];

            foreach ($postTags as $postTag) {
                $arrPostTags[] = $postTag->id;
            }

            $post->tags()->attach($postTags->pluck('id'));
            //$post->tags()->attach($arrPostTags);
        }
    }
}
