<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminGen::class);
        $this->call(SaleDate::class);
        $this->call(CategoriesGen::class);
        $this->call(SubCategoryGen::class);
        $this->call(HomeCategories::class);
        $this->call(HomeSliderGen::class);
        \App\Models\Product::factory(30)->create();
    }
}
