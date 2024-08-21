<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $colors = [
            'Red', 'Blue', 'Green', 'Yellow', 'Orange', 'Purple', 'Pink', 'Black',
            'White', 'Brown', 'Gray', 'Cyan', 'Magenta', 'Turquoise', 'Indigo',
            'Violet', 'Maroon', 'Teal', 'Coral', 'Gold', 'Silver', 'Lavender',
            'Olive', 'Peach', 'Tan', 'Slate', 'Beige', 'Navy', 'Crimson', 'Aqua',
            'Ivory', 'Burgundy', 'Mauve', 'Salmon', 'Chartreuse', 'Orchid',
            'Periwinkle', 'Sienna', 'Sky Blue', 'Lilac', 'Eggplant', 'Forest Green',
            'Tangerine', 'Ruby', 'Lemon', 'Fuchsia', 'Khaki', 'Cornflower', 'Mustard'
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'color_name' => $color,
            ]);
        }
    }
}
