<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::get();
        foreach ($categories as $categorey){
            $peoduct1 = Product::updateOrCreate([
                'name' => "Product1 " . $categorey->name,
            ], [
                'category_id' => $categorey->id,
                'slug' => Str::slug("Product1 " . $categorey->name),
                'description' => "Product1 desc " . $categorey->name,
            ]);
            ProductImage::create([
                'product_id' => $peoduct1->id,
                'type' => 'main',
            ]);

            $peoduct2 = Product::updateOrCreate([
                'name' => "Product2 " . $categorey->name,
            ], [
                'category_id' => $categorey->id,
                'slug' => Str::slug("Product2 " . $categorey->name),
                'description' => "Product2 desc " . $categorey->name,
            ]);
            ProductImage::create([
                'product_id' => $peoduct2->id,
                'type' => 'main',
            ]);
        }



    }
}
