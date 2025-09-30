<?php

namespace Modules\ClientLogo\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\ClientLogo\Models\ClientLogo;

class ClientLogoDatabaseSeeder extends Seeder
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

        $now = now();

        $logos = [
            ['client_name' => 'Google',    'logo' => 'img/clients/google.png',    'website_url' => 'https://www.google.com',    'is_active' => true, 'sort_order' => 1],
            ['client_name' => 'Facebook',  'logo' => 'img/clients/facebook.png',  'website_url' => 'https://www.facebook.com',  'is_active' => true, 'sort_order' => 2],
            ['client_name' => 'YouTube',   'logo' => 'img/clients/youtube.png',   'website_url' => 'https://www.youtube.com',   'is_active' => true, 'sort_order' => 3],
            ['client_name' => 'Twitter',   'logo' => 'img/clients/twitter.png',   'website_url' => 'https://twitter.com',       'is_active' => true, 'sort_order' => 4],
            ['client_name' => 'Instagram', 'logo' => 'img/clients/instagram.png', 'website_url' => 'https://www.instagram.com', 'is_active' => true, 'sort_order' => 5],
            ['client_name' => 'LinkedIn',  'logo' => 'img/clients/linkedin.png',  'website_url' => 'https://www.linkedin.com',  'is_active' => true, 'sort_order' => 6],
            ['client_name' => 'Netflix',   'logo' => 'img/clients/netflix.png',   'website_url' => 'https://www.netflix.com',   'is_active' => true, 'sort_order' => 7],
            ['client_name' => 'Amazon',    'logo' => 'img/clients/amazon.png',    'website_url' => 'https://www.amazon.com',    'is_active' => true, 'sort_order' => 8],
            ['client_name' => 'Spotify',   'logo' => 'img/clients/spotify.png',   'website_url' => 'https://www.spotify.com',   'is_active' => true, 'sort_order' => 9],
            ['client_name' => 'Adobe',     'logo' => 'img/clients/adobe.png',     'website_url' => 'https://www.adobe.com',     'is_active' => true, 'sort_order' => 10],
        ];

        foreach ($logos as $logo) {
            ClientLogo::firstOrCreate(
                ['client_name' => $logo['client_name']],
                [
                    'logo' => $logo['logo'],
                    'website_url' => $logo['website_url'],
                    'is_active' => $logo['is_active'],
                    'sort_order' => $logo['sort_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
