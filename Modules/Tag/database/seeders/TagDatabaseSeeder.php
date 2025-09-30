<?php

namespace Modules\Tag\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Models\Tag;

class TagDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET session_replication_role = \'replica\';');

        /*
         * Tags Seed
         * ------------------
         */

        // DB::table('tags')->truncate();
        // echo "Truncate: tags \n";

        Tag::factory()->count(5)->create();
        $rows = Tag::all();
        echo " Insert: tags \n\n";

        // Enable foreign key checks!
        DB::statement('SET session_replication_role = \'origin\';');
    }
}
