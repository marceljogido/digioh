<?php

namespace Modules\Portfolio\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Portfolio\Models\Portfolio;

class PortfolioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Portfolios Seed
         * ------------------
         */

        // DB::table('portfolios')->truncate();
        // echo "Truncate: portfolios \n";

        Portfolio::factory()->count(20)->create();
        $rows = Portfolio::all();
        echo " Insert: portfolios \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
