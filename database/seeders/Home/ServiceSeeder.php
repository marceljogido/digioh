<?php

namespace Database\Seeders\Home;

use App\Enums\ServiceStatus;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Strategi Digital & Discovery',
                'name_en' => 'Digital Strategy & Discovery',
                'description' => 'Kami bekerja bersama Anda untuk memahami kebutuhan bisnis dan menyusun roadmap produk yang realistis serta terukur.',
                'description_en' => 'We work together with you to understand business needs and develop a realistic and measurable product roadmap.',
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 015.273-3.12c.37-.08.63-.391.63-.772V4.5a.75.75 0 01.75-.75A2.25 2.25 0 0118 6v2.25c0 .621.504 1.125 1.125 1.125h1.006c1.026 0 1.945.694 2.054 1.715a9.03 9.03 0 01-.972 5.186M6.633 10.5a2.25 2.25 0 10-3.633 2.769 8.966 8.966 0 00.614 5.093c.16.363.502.588.889.588H9.75A2.25 2.25 0 0012 16.5v-1.125c0-.621-.504-1.125-1.125-1.125h-.642c-.598 0-1.05-.533-.879-1.11a9.04 9.04 0 011.493-2.88M6.633 10.5a9.06 9.06 0 011.74 4.5"/></svg>',
                'image' => 'img/services/strategy.svg',
                'is_active' => 1,
                'featured_on_home' => 1,
                'status' => ServiceStatus::Published->value,
                'sort_order'  => 1
            ],
            [
                'name' => 'Desain Experience & Branding',
                'name_en' => 'Experience Design & Branding',
                'description' => 'Tim UI/UX kami membangun tampilan yang elegan dan mudah digunakan, lengkap dengan guideline merek yang konsisten di semua saluran.',
                'description_en' => 'Our UI/UX team builds elegant and user-friendly interfaces, complete with consistent brand guidelines across all channels.',
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 017.5 15.75m11.85-5.603a60.436 60.436 0 01.491 6.347 48.623 48.623 0 00-3.572-2.804M7.5 15.75l2.25-1.5m6.75 0l-2.25-1.5m-2.25 1.5l.36-.24c.284-.19.426-.285.426-.41 0-.125-.142-.22-.426-.41L12 12.75m0 2.25l-.36.24c-.284.19-.426.285-.426.41 0 .125.142.22.426.41l.36.24m0-1.3l2.25-1.5m-2.25 1.5l-2.25-1.5M7.5 19.5l3.75-2.5m5.25 0l-3.75 2.5M3 9.75c2.347-1.718 5.16-2.75 9-2.75s6.653 1.032 9 2.75M3 9.75C4.89 11.737 8.247 12.75 12 12.75s7.11-1.013 9-3M3 9.75A49.087 49.087 0 0112 9c3.328 0 6.165.3 9 .75"/></svg>',
                'image' => 'img/services/design.svg',
                'is_active' => 1,
                'featured_on_home' => 1,
                'status' => ServiceStatus::Published->value,
                'sort_order' => 2
            ],
            [
                'name' => 'Pengembangan Produk End-to-End',
                'name_en' => 'End-to-End Product Development',
                'description' => 'Kami membangun aplikasi web maupun mobile yang skalabel dengan praktik engineering modern, CI/CD, dan pengujian menyeluruh.',
                'description_en' => 'We build scalable web and mobile applications with modern engineering practices, CI/CD, and comprehensive testing.',
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM13.5 6A2.25 2.25 0 0115.75 3.75H18a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0112.5 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 15.75A2.25 2.25 0 0115.75 13.5H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>',
                'image' => 'img/services/development.svg',
                'is_active' => 1,
                'featured_on_home' => 1,
                'status' => ServiceStatus::Published->value,
                'sort_order' => 3
            ],
            [
                'name' => 'Optimalisasi & Growth Marketing',
                'name_en' => 'Optimization & Growth Marketing',
                'description' => 'Kami mendukung peluncuran dan pengembangan produk melalui analitik, eksperimen, dan kampanye digital yang terukur.',
                'description_en' => 'We support product launches and growth through analytics, experiments, and measurable digital campaigns.',
                'icon' => '<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l7.5 7.5V13.5H3zM3 10.5h7.5V3L3 10.5zm10.5 0H21L13.5 3v7.5zm0 3H21l-7.5 7.5V13.5z"/></svg>',
                'image' => 'img/services/marketing.svg',
                'is_active' => 1,
                'featured_on_home' => 1,
                'status' => ServiceStatus::Published->value,
                'sort_order' => 4
            ]
        ];

        foreach ($services as $serviceData) {
            $service = Service::where('name', $serviceData['name'])->first();

            $serviceData['image'] = $this->resolveImagePath($service, $serviceData['image']);

            Service::updateOrCreate(
                ['name' => $serviceData['name']],
                $serviceData
            );
        }
    }

    protected function resolveImagePath(?Service $existing, ?string $seedPath): ?string
    {
        if ($existing && $existing->image && Str::startsWith($existing->image, '/storage/')) {
            return $existing->image;
        }

        if ($seedPath) {
            $fullPath = public_path($seedPath);

            if (file_exists($fullPath)) {
                return $seedPath;
            }
        }

        return 'img/service-placeholder.svg';
    }
}
