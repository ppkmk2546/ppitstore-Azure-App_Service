<?php

namespace Database\Seeders;

use App\Models\HomeSlider;
use Illuminate\Database\Seeder;

class HomeSliderGen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homeslider = HomeSlider::where('title', '=', 'Sample Slider 1')->first();
        if ($homeslider === null) {
            for($i=1; $i<=2; $i++){
                $homeslider = HomeSlider::create([
                    'title' => 'Sample Slider '.$i,
                    'subtitle' => 'This section can add update and delete in admin dashboard.',
                    'price' => '29999',
                    'link' => '/shop',
                    'image' => 'sample_slider.png',
                    'status' => '1',
                ]);
            }
        }
    }
}
