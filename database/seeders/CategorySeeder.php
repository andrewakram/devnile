<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'name' => 'Categorey1',
        ], [
            'slug' => Str::slug('Categorey1'),
            'icon' => 'fas fa-car',
        ]);

        Category::updateOrCreate([
            'name' => 'Categorey2',
        ], [
            'slug' => Str::slug('Categorey2'),
            'icon' => 'fas fa-calendar',
        ]);

        Category::updateOrCreate([
            'name' => 'Categorey3',
        ], [
            'slug' => Str::slug('Categorey3'),
            'icon' => 'fas fa-shopping-cart',
        ]);
    }
}
