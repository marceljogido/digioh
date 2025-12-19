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
        // Truncate existing data
        Faq::truncate();

        $faqs = [
            [
                'question' => ['id' => 'Berapa lama estimasi pengerjaan satu proyek digital?', 'en' => 'How long does it take to complete a digital project?'],
                'answer' => ['id' => 'Waktu pengerjaan bergantung pada kompleksitas fitur. Rata-rata produk digital MVP kami selesaikan dalam 8-12 minggu termasuk fase discovery, desain, serta pengembangan.', 'en' => 'The duration depends on feature complexity. On average, we complete an MVP digital product in 8-12 weeks including discovery, design, and development phases.'],
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'question' => ['id' => 'Apakah tim kami bisa berkolaborasi dengan tim internal klien?', 'en' => 'Can your team collaborate with our internal team?'],
                'answer' => ['id' => 'Tentu. Kami terbiasa bekerja secara kolaboratif lewat sprint mingguan, ritual agile, dan alat komunikasi yang transparan agar tim internal Anda tetap terinformasi.', 'en' => 'Absolutely. We are used to working collaboratively through weekly sprints, agile rituals, and transparent communication tools to keep your internal team informed.'],
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'question' => ['id' => 'Layanan purna jual apa saja yang tersedia?', 'en' => 'What after-sales services are available?'],
                'answer' => ['id' => 'Kami menyediakan support operasional, maintenance, optimalisasi performa, hingga growth marketing untuk produk yang sudah dirilis.', 'en' => 'We provide operational support, maintenance, performance optimization, and growth marketing for released products.'],
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'question' => ['id' => 'Bagaimana pola kerja dan metode pembiayaan di Digioh?', 'en' => 'What are the work patterns and payment methods at Digioh?'],
                'answer' => ['id' => 'Kami fleksibel dengan model fixed scope maupun retainer. Setelah discovery selesai, kami serahkan proposal detail lengkap dengan timeline, deliverable, dan estimasi biaya.', 'en' => 'We are flexible with both fixed scope and retainer models. After discovery is complete, we provide a detailed proposal with timeline, deliverables, and cost estimates.'],
                'is_active' => true,
                'sort_order' => 4
            ]
        ];

        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }
    }
}