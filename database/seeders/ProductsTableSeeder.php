<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Example product data
        // Product::create([
        //     'name' => 'Product 1',
        //     'description' => 'Description for product 1',
        //     'price' => 19.99,
        //     'quantity' => 100,
        //     'status' => 'available',
        // ]);

        // Product::create([
        //     'name' => 'Product 2',
        //     'description' => 'Description for product 2',
        //     'price' => 29.99,
        //     'quantity' => 200,
        //     'status' => 'available',
        // ]);
        Product::factory()->count(500)->create();

        // You can add more product data here
    }
}
