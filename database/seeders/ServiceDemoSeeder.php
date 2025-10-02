<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Photobooth',
                'slug' => 'photobooth',
                'description' => '<p>Layanan photobooth interaktif dengan backdrop kustom, cetak instan, dan berbagi digital.</p>',
                'icon' => '<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 6.75A2.25 2.25 0 016 4.5h2.25m-4.5 2.25v12A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25v-12M10.5 4.5h3m1.5 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>',
                'image' => 'img/service-photobooth.svg',
                'is_active' => true,
                'featured_on_home' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Digirental',
                'slug' => 'digirental',
                'description' => '<p>Sewa perangkat digital untuk event: tablet, kiosk, printer, dan perangkat pendukung lainnya.</p>',
                'icon' => '<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.75h4.5m-9 0h1.5m9 0h1.5M4.5 6.75h15m-12 3h9m-9 3h6m-6 3h3M4.5 6.75A1.5 1.5 0 003 8.25v9A3.75 3.75 0 006.75 21h10.5A3.75 3.75 0 0021 17.25v-9a1.5 1.5 0 00-1.5-1.5H4.5z"/></svg>',
                'image' => 'img/service-digirental.svg',
                'is_active' => true,
                'featured_on_home' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Event Production',
                'slug' => 'event-production',
                'description' => '<p>Produksi event end-to-end: konsep, eksekusi, dokumentasi, dan optimasi pasca-event.</p>',
                'icon' => '<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6 3.75v3m12-3v3M3.75 9.75h16.5m-12 3h7.5m-7.5 3h7.5m-12 3h16.5"/></svg>',
                'image' => 'img/service-event.svg',
                'is_active' => true,
                'featured_on_home' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $data) {
            Service::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}

