<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\OurWork\Models\OurWork;

class OurWorkDemoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Photobooth Grand Launch',
                'slug' => 'photobooth-grand-launch',
                'excerpt' => 'Aktivasi photobooth untuk peluncuran produk dengan antrian interaktif dan cetak instan.',
                'description' => 'Kami menyiapkan alur antrian, template cetak kustom, dan integrasi sharing sosial untuk meningkatkan jangkauan acara.',
                'icon_class' => 'fa-solid fa-camera-retro',
                'featured_on_home' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Digirental Roadshow',
                'slug' => 'digirental-roadshow',
                'excerpt' => 'Sewa perangkat digital untuk roadshow nasional 10 kota.',
                'description' => 'Pengadaan, konfigurasi, dan support on-site untuk tablet, kiosk, dan printer selama roadshow.',
                'icon_class' => 'fa-solid fa-tablet-screen-button',
                'featured_on_home' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Expo Engagement Booth',
                'slug' => 'expo-engagement-booth',
                'excerpt' => 'Booth interaktif dengan gamifikasi untuk meningkatkan engagement pengunjung.',
                'description' => 'Rancang alur permainan, leaderboard, dan hadiah untuk memaksimalkan retensi booth.',
                'icon_class' => 'fa-solid fa-gamepad',
                'featured_on_home' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $data) {
            OurWork::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}

