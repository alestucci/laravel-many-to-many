<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'News',
            ],
            [
                'name' => 'Sport',
            ],
            [
                'name' => 'Cinema',
            ],
            [
                'name' => 'Music',
            ],
            [
                'name' => 'Technology',
            ],
            [
                'name' => 'Other',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
