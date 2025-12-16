<?php

namespace Database\Seeders\Content;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama estimasi pengerjaan satu proyek digital?',
                'answer' => 'Waktu pengerjaan bergantung pada kompleksitas fitur. Rata-rata produk digital MVP kami selesaikan dalam 8-12 minggu termasuk fase discovery, desain, serta pengembangan.',
                'is_active' => 1,
                'sort_order' => 1
            ],
            [
                'question' => 'Apakah tim kami bisa berkolaborasi dengan tim internal klien?',
                'answer' => 'Tentu. Kami terbiasa bekerja secara kolaboratif lewat sprint mingguan, ritual agile, dan alat komunikasi yang transparan agar tim internal Anda tetap terinformasi.',
                'is_active' => 1,
                'sort_order' => 2
            ],
            [
                'question' => 'Layanan purna jual apa saja yang tersedia?',
                'answer' => 'Kami menyediakan support operasional, maintenance, optimalisasi performa, hingga growth marketing untuk produk yang sudah dirilis.',
                'is_active' => 1,
                'sort_order' => 3
            ],
            [
                'question' => 'Bagaimana pola kerja dan metode pembiayaan di Digioh?',
                'answer' => 'Kami fleksibel dengan model fixed scope maupun retainer. Setelah discovery selesai, kami serahkan proposal detail lengkap dengan timeline, deliverable, dan estimasi biaya.',
                'is_active' => 1,
                'sort_order' => 4
            ]
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(
                ['question' => $faqData['question']],
                $faqData
            );
        }
    }
}