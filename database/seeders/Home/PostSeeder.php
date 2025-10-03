<?php

namespace Database\Seeders\Home;

use Illuminate\Database\Seeder;
use Modules\Post\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'name' => 'Strategi Digital untuk Bisnis UMKM di Era Modern',
                'slug' => 'strategi-digital-bisnis-umkm',
                'intro' => 'Panduan praktis untuk UMKM mengadopsi teknologi dalam operasional bisnis sehari-hari.',
                'content' => '<p>Bisnis UMKM saat ini dihadapkan pada tantangan untuk tetap kompetitif di era digital. Artikel ini membahas strategi implementasi teknologi yang efektif dan terjangkau.</p>',
                'image' => 'img/posts/digital-strategy.jpg',
                'status' => 1,
                'is_featured' => 1,
                'published_at' => now()->subDays(2),
                'sort_order' => 1
            ],
            [
                'name' => 'Pentingnya UX dalam Desain Produk Digital',
                'slug' => 'pentingnya-ux-dalam-desain-produk',
                'intro' => 'Mengapa pengalaman pengguna menjadi faktor kunci dalam kesuksesan produk digital.',
                'content' => '<p>Desain pengalaman pengguna (UX) bukan hanya tentang tampilan yang menarik, tetapi juga tentang kemudahan penggunaan dan kepuasan pengguna dalam berinteraksi dengan produk digital.</p>',
                'image' => 'img/posts/ux-design.jpg',
                'status' => 1,
                'is_featured' => 1,
                'published_at' => now()->subDays(5),
                'sort_order' => 2
            ],
            [
                'name' => 'Tren Teknologi yang Membentuk Masa Depan Bisnis',
                'slug' => 'tren-teknologi-masa-depan-bisnis',
                'intro' => 'Tinjauan terhadap teknologi-teknologi terkini yang akan mengubah lanskap bisnis.',
                'content' => '<p>Artificial Intelligence, Internet of Things, dan teknologi blockchain adalah beberapa tren yang akan menentukan masa depan bisnis di Indonesia dan dunia.</p>',
                'image' => 'img/posts/tech-trends.jpg',
                'status' => 1,
                'is_featured' => 1,
                'published_at' => now()->subDays(8),
                'sort_order' => 3
            ]
        ];

        foreach ($posts as $postData) {
            Post::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );
        }
    }
}