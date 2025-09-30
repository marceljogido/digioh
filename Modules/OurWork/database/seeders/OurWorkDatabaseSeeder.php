<?php

namespace Modules\OurWork\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\OurWork\Models\OurWork;

class OurWorkDatabaseSeeder extends Seeder
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
         * OurWorks Seed
         * ------------------
         */

        // DB::table('ourworks')->truncate();
        // echo "Truncate: ourworks \n";

        OurWork::factory()->count(20)->create();
        $rows = OurWork::all();
        echo " Insert: ourworks \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
