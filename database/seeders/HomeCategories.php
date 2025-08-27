<?php

namespace Database\Seeders;

use App\Models\HomeCategory;
use Illuminate\Database\Seeder;

class HomeCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homecategory = HomeCategory::where('sel_categories', '=', '1,2,3,4,5,7')->first();
        if ($homecategory === null) {
            $homecategory = HomeCategory::create([
                'sel_categories' => '1,2,3,4,5,7',
                'no_of_products' => '8',
            ]);
        }
    }
}
