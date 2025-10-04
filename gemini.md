Prompt Gemini

Saya ingin Anda implementasikan ulang perubahan berikut pada project Laravel saya:

Form Create Post terlalu banyak input. Tolong sederhanakan agar hanya ada field utama:

Judul

Deskripsi/Konten

Gambar (upload)

Tanggal Mulai

Tanggal Selesai

Lokasi

Sidebar admin: ubah label menu Posts menjadi Our Work.

Route tetap menggunakan backend.posts.index (jangan diganti jadi our-work).

View tetap menggunakan backend.posts.* (jangan ubah nama file atau direktori).

Jadi yang berubah hanya teks/wording di sidebar.

Pastikan konten Posts/Our Work tetap bisa tampil di halaman Our Work dan juga bisa ditampilkan di Home.

Hindari kesalahan sebelumnya:

Jangan ubah nama route backend.posts.index.

Jangan ubah nama view backend.posts.index_datatable.

Perubahan fokus hanya pada Blade template sidebar (sidebar.php) dan Blade template create post.

Tolong berikan:

Potongan kode sidebar.php untuk mengganti label Posts → Our Work tanpa mengubah routing.

Potongan kode create.blade.php versi sederhana dengan field yang disebutkan di atas.