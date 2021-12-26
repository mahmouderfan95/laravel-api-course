<?php

use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['id' => 1,'name' => 'product1','description' => 'desc1','price' => 100,'image' => 'https://cdn.pixabay.com/photo/2019/07/13/13/42/watch-4334815_960_720.jpg','color' => 'red','size' => 'xl','category_id' => 1],
            ['id' => 2,'name' => 'product2','description' => 'desc2','price' => 150,'image' => 'https://cdn.pixabay.com/photo/2019/07/13/13/42/watch-4334815_960_720.jpg','color' => 'green','size' => 'm','category_id' => 2],
            ['id' => 3,'name' => 'product3','description' => 'desc3','price' => 200,'image' => 'https://cdn.pixabay.com/photo/2019/07/13/13/42/watch-4334815_960_720.jpg','color' => 'blue','size' => 'l','category_id' => 3],
            ['id' => 4,'name' => 'product4','description' => 'desc4','price' => 250,'image' => 'https://cdn.pixabay.com/photo/2019/07/13/13/42/watch-4334815_960_720.jpg','color' => 'black','size' => '2xl','category_id' => 3],
        ];

        foreach ($products as $product){
            $productCreate = \App\Models\Product::create($product);
        }
    }
}
