<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleDate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale = Sale::where('sale_date', '=', '2077-01-01 00:00:00.000')->first();
        if ($sale === null) {
            $sale = Sale::create([
                'sale_date' => '2077-01-01 00:00:00.000',
                'status' => '1',
            ]);
        }
    }
}
