<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Home\SliderSeeder;
use Database\Seeders\Home\ClientLogoSeeder;
use Database\Seeders\Home\ServiceSeeder;
use Database\Seeders\Home\FaqSeeder;
use Database\Seeders\Home\PostSeeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SliderSeeder::class,
            ClientLogoSeeder::class,
            ServiceSeeder::class,
            FaqSeeder::class,
            PostSeeder::class,
        ]);
    }
}
