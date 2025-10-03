<?php

namespace Database\Seeders\Home;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\OurWork\Models\OurWork;

class OurWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ourWorks = [
            [
                'name' => 'Aplikasi E-Commerce Modern',
                'slug' => 'aplikasi-e-commerce-modern',
                'excerpt' => 'Pengembangan platform e-commerce lengkap dengan fitur manajemen produk, pembayaran digital, dan sistem logistik terintegrasi.',
                'description' => '<p>Pengembangan platform e-commerce lengkap dengan fitur manajemen produk, pembayaran digital, dan sistem logistik terintegrasi.</p>',
                'featured_on_home' => 1,
                'is_active' => 1,
                'sort_order' => 1
            ],
            [
                'name' => 'Sistem Manajemen HRD',
                'slug' => 'sistem-manajemen-hrd',
                'excerpt' => 'Sistem komprehensif untuk manajemen SDM termasuk absensi, cuti, gaji, dan kinerja karyawan.',
                'description' => '<p>Sistem komprehensif untuk manajemen SDM termasuk absensi, cuti, gaji, dan kinerja karyawan.</p>',
                'featured_on_home' => 1,
                'is_active' => 1,
                'sort_order' => 2
            ],
            [
                'name' => 'Platform Pembelajaran Online',
                'slug' => 'platform-pembelajaran-online',
                'excerpt' => 'Platform LMS untuk institusi pendidikan dengan fitur kelas virtual, ujian online, dan pelacakan kemajuan siswa.',
                'description' => '<p>Platform LMS untuk institusi pendidikan dengan fitur kelas virtual, ujian online, dan pelacakan kemajuan siswa.</p>',
                'featured_on_home' => 1,
                'is_active' => 1,
                'sort_order' => 3
            ]
        ];

        foreach ($ourWorks as $ourWorkData) {
            OurWork::updateOrCreate(
                ['slug' => $ourWorkData['slug']],
                $ourWorkData
            );
        }
    }
}