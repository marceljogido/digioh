<?php

namespace Database\Seeders\Home;

use Illuminate\Database\Seeder;
use Modules\ClientLogo\Models\ClientLogo;

class ClientLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientLogos = [
            [
                'client_name' => 'PT. ABC Teknologi',
                'logo' => 'img/clients/abc-teknologi.png',
                'website_url' => 'https://abcteknologi.com',
                'is_active' => 1,
                'sort_order' => 1
            ],
            [
                'client_name' => 'PT. XYZ Solusi',
                'logo' => 'img/clients/xyz-solusi.png',
                'website_url' => 'https://xyzsolusi.com',
                'is_active' => 1,
                'sort_order' => 2
            ],
            [
                'client_name' => 'PT. Digital Kreatif',
                'logo' => 'img/clients/digital-kreatif.png',
                'website_url' => 'https://digitalkreatif.com',
                'is_active' => 1,
                'sort_order' => 3
            ],
            [
                'client_name' => 'PT. Inovasi Nusantara',
                'logo' => 'img/clients/inovasi-nusantara.png',
                'website_url' => 'https://inovasinusantara.com',
                'is_active' => 1,
                'sort_order' => 4
            ],
            [
                'client_name' => 'PT. Teknologi Maju',
                'logo' => 'img/clients/teknologi-maju.png',
                'website_url' => 'https://teknologimaju.com',
                'is_active' => 1,
                'sort_order' => 5
            ]
        ];

        foreach ($clientLogos as $clientLogoData) {
            ClientLogo::updateOrCreate(
                ['client_name' => $clientLogoData['client_name']],
                $clientLogoData
            );
        }
    }
}