<?php

namespace Database\Seeders;

use Database\Seeders\Auth\AttachSliderClientLogoPermissionsSeeder;
use Database\Seeders\Content\ClientLogoSeeder;
use Database\Seeders\Content\FaqSeeder;
use Database\Seeders\Content\PostSeeder;
use Database\Seeders\Content\ServiceSeeder;
use Database\Seeders\Content\SliderSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Category\database\seeders\CategoryDatabaseSeeder;
use Modules\Tag\database\seeders\TagDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Auth - Users, Roles, Permissions
        $this->call(AuthTableSeeder::class);
        $this->call(AttachSliderClientLogoPermissionsSeeder::class);
        
        // Content - Posts, Services, Sliders, etc
        $this->call(CategoryDatabaseSeeder::class);
        $this->call(TagDatabaseSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(ClientLogoSeeder::class);

        Schema::enableForeignKeyConstraints();
        $this->call(SettingsTableSeeder::class);
    }
}
