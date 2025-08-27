<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesGen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('name', '=', 'Hardware Computer')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Hardware Computer',
                'slug' => 'hardware-computer',
            ]);
        }

        $category = Category::where('name', '=', 'Software Computer')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Software Computer',
                'slug' => 'software-computer',
            ]);
        }

        $category = Category::where('name', '=', 'Storage')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Storage',
                'slug' => 'storage',
            ]);
        }

        $category = Category::where('name', '=', 'Notebook')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Notebook',
                'slug' => 'notebook',
            ]);
        }

        $category = Category::where('name', '=', 'Computer Brands')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Computer Brands',
                'slug' => 'computer-brands',
            ]);
        }

        $category = Category::where('name', '=', 'Monitor')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Monitor',
                'slug' => 'monitor',
            ]);
        }

        $category = Category::where('name', '=', 'Gaming Gear')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Gaming Gear',
                'slug' => 'gaming-gear',
            ]);
        }

        $category = Category::where('name', '=', 'Smartphone & Tablet')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Smartphone & Tablet',
                'slug' => 'smartphone-tablet',
            ]);
        }

        $category = Category::where('name', '=', 'Streamer Gadget')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Streamer Gadget',
                'slug' => 'streamer-gadget',
            ]);
        }

        $category = Category::where('name', '=', 'Peripherals')->first();
        if ($category === null) {
            $category = category::create([
                'name' => 'Peripherals',
                'slug' => 'peripherals',
            ]);
        }
    }
}
