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
            ['id' => 1,'name' => 'product1','description' => 'desc1','price' => 100,'category_id' => 1],
            ['id' => 2,'name' => 'product2','description' => 'desc2','price' => 150,'category_id' => 2],
            ['id' => 3,'name' => 'product3','description' => 'desc3','price' => 200,'category_id' => 3],
            ['id' => 4,'name' => 'product4','description' => 'desc4','price' => 250,'category_id' => 3],
        ];

        foreach ($products as $product){
            $productCreate = \App\Models\Product::create($product);
        }
    }
}
