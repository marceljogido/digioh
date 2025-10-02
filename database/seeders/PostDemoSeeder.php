<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Post\Models\Post;
use App\Models\Service;
use Carbon\Carbon;

class PostDemoSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::first();
        $now = Carbon::now();
        $items = [
            [
                'name' => 'Behind The Scene: Photobooth Grand Launch',
                'slug' => 'behind-the-scene-photobooth-grand-launch',
                'intro' => 'Sedikit cerita soal konfigurasi antrian dan template cetak yang kami pakai.',
                'content' => '<p>Tim menyiapkan workflow antrian, preset kamera, dan integrasi QR untuk mempercepat aktivasi.</p>',
                'type' => 'Article',
                'category_id' => null,
                'is_featured' => 1,
                'image' => 'img/service-photobooth.svg',
                'status' => 'Published',
                'published_at' => $now->copy()->subDays(3),
                'service_id' => optional($service)->id,
            ],
            [
                'name' => 'Roadshow Checklist: Digirental Edition',
                'slug' => 'roadshow-checklist-digirental-edition',
                'intro' => 'Checklist praktis saat mengelola perangkat digital untuk roadshow multi kota.',
                'content' => '<p>Dari logistik, setup, hingga support harian, berikut hal-hal penting yang kami jalankan.</p>',
                'type' => 'Article',
                'category_id' => null,
                'is_featured' => 1,
                'image' => 'img/service-digirental.svg',
                'status' => 'Published',
                'published_at' => $now->copy()->subDays(2),
                'service_id' => optional($service)->id,
            ],
            [
                'name' => 'Gamifikasi di Expo: Apa yang Bekerja?',
                'slug' => 'gamifikasi-di-expo-apa-yang-bekerja',
                'intro' => 'Membahas mekanik permainan, hadiah, dan dampaknya terhadap engagement.',
                'content' => '<p>Kami membandingkan beberapa mekanik populer dan metrik performanya.</p>',
                'type' => 'Article',
                'category_id' => null,
                'is_featured' => 1,
                'image' => 'img/service-event.svg',
                'status' => 'Published',
                'published_at' => $now->copy()->subDay(),
                'service_id' => optional($service)->id,
            ],
        ];

        foreach ($items as $data) {
            Post::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}

