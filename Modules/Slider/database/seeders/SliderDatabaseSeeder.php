<?php

namespace Modules\Slider\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Slider\Models\Slider;

class SliderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver = config('database.default');
        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        /*
         * Sliders Seed
         * ------------------
         */

        // DB::table('sliders')->truncate();
        // echo "Truncate: sliders \n";

        // Slider::factory()->count(20)->create();
        $rows = Slider::all();
        echo " Insert: sliders \n\n";

        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
