<?php

use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1,'title' => 'category 1 ', 'description' => 'description one'],
            ['id' => 2,'title' => 'category 2 ', 'description' => 'description two'],
            ['id' => 3,'title' => 'category 3 ', 'description' => 'description three'],
            ['id' => 4,'title' => 'category 4 ', 'description' => 'description four'],
            ['id' => 5,'title' => 'category 5 ', 'description' => 'description five'],
        ];

        foreach ($categories as $category){
            $categoryCreate = \App\Models\Category::create($category);
        }
    }
}
