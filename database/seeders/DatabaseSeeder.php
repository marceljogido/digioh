<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Home\SliderSeeder;
use Modules\Category\database\seeders\CategoryDatabaseSeeder;
use Modules\Post\database\seeders\PostDatabaseSeeder;
use Modules\Tag\database\seeders\TagDatabaseSeeder;
use Database\Seeders\Auth\AttachSliderClientLogoPermissionsSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call(AuthTableSeeder::class);
        $this->call(PostDatabaseSeeder::class);
        $this->call(CategoryDatabaseSeeder::class);
        $this->call(TagDatabaseSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(AttachSliderClientLogoPermissionsSeeder::class);
        
        // Ensure admin user exists with correct password
        $this->call(EnsureAdminUserSeeder::class);

        Schema::enableForeignKeyConstraints();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
