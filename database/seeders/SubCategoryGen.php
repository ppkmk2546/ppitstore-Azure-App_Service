<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubCategoryGen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategory = Subcategory::where('name', '=', 'Cpu')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Cpu',
                'slug' => 'cpu',
                'category_id' => '1',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Microsoft Windows')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Microsoft Windows',
                'slug' => 'microsoft-windows',
                'category_id' => '2',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Hard Disk & Solid State Disk')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Hard Disk & Solid State Disk',
                'slug' => 'hard-disk-solid-state-disk',
                'category_id' => '3',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Gaming Notebook')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Gaming Notebook',
                'slug' => 'gaming-notebook',
                'category_id' => '4',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Desktop Computer')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Desktop Computer',
                'slug' => 'desktop-computer',
                'category_id' => '5',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Gaming Monitor')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Gaming Monitor',
                'slug' => 'gaming-monitor',
                'category_id' => '6',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Gaming Desk')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Gaming Desk',
                'slug' => 'gaming-desk',
                'category_id' => '7',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Smartphone')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'category_id' => '8',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Sound Component')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Sound Component',
                'slug' => 'sound-component',
                'category_id' => '9',
            ]);
        }

        $subcategory = Subcategory::where('name', '=', 'Projector')->first();
        if ($subcategory === null) {
            $subcategory = Subcategory::create([
                'name' => 'Projector',
                'slug' => 'projector',
                'category_id' => '10',
            ]);
        }
    }
}
