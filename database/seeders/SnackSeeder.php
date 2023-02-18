<?php

namespace Database\Seeders;

use App\Models\Snack;
use Illuminate\Database\Seeder;

class SnackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Snack::create([
          'name' => 'Potato Chips',
          'price' => 250,
          'stock' => 1,
        ]);
        Snack::create([
          'name' => 'Chocolate Cookies',
          'price' => 325,
          'stock' => 3,
        ]);
        Snack::create([
          'name' => 'Popcorn',
          'price' => 375,
          'stock' => 2,
        ]);
    }
}
