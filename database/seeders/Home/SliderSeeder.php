<?php

namespace Database\Seeders\Home;

use Illuminate\Database\Seeder;
use Modules\Slider\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::truncate();

        $sliders = [
            [
                'title' => 'Solusi Digital Terbaik untuk Bisnis Anda',
                'subtitle' => 'Tim kami membantu Anda dari ide hingga produk digital yang berdampak',
                'image' => 'img/sliders/slider-1.jpg',
                'button_text' => 'Diskusikan Proyek Anda',
                'button_link' => '/contact',
                'is_active' => 1,
                'sort_order' => 1
            ],
            [
                'title' => 'Transformasi Digital dengan Pendekatan Strategis',
                'subtitle' => 'Kami menyusun roadmap produk yang realistis dan terukur untuk bisnis Anda',
                'image' => 'img/sliders/slider-2.jpg',
                'button_text' => 'Pelajari Proses Kami',
                'button_link' => '/about',
                'is_active' => 1,
                'sort_order' => 2
            ],
            [
                'title' => 'Pengembangan Produk End-to-End',
                'subtitle' => 'Pembuatan aplikasi web dan mobile yang skalabel dengan praktik engineering modern',
                'image' => 'img/sliders/slider-3.jpg',
                'button_text' => 'Lihat Portofolio',
                'button_link' => '/services',
                'is_active' => 1,
                'sort_order' => 3
            ]
        ];

        foreach ($sliders as $sliderData) {
            Slider::updateOrCreate(
                ['title' => $sliderData['title']],
                $sliderData
            );
        }
    }
}