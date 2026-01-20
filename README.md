<p align="center"><img src="public/img/logo-with-text.jpg" alt="DigiOH - Digital Studio Indonesia"></p>

# DigiOH Digital Studio Website

**DigiOH** adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi modern. Website ini dibangun menggunakan Laravel 12.x dengan fitur-fitur seperti `Authentication`, `Authorization`, `Content Management`, `Portfolio Management`, dan `Service Management`.

## Layanan Kami

- **Strategi Digital & Discovery** - Memahami kebutuhan bisnis dan menyusun roadmap produk
- **Desain Experience & Branding** - UI/UX elegan dengan guideline merek konsisten
- **Pengembangan Produk End-to-End** - Aplikasi web & mobile yang skalabel
- **Optimalisasi & Growth Marketing** - Analitik dan kampanye digital terukur

***Hubungi kami untuk konsultasi proyek digital Anda.***

---

## Website

🌐 **Live URL**: https://digioh.id

Untuk akses admin panel, silakan hubungi tim DigiOH di hello@digioh.id

---

## Reporting a Vulnerability

Jika Anda menemukan masalah keamanan, silakan kirim email ke tim DigiOH via **hello@digioh.id** (jangan gunakan issue tracker).

---

## Installation

### Requirements
- PHP 8.2+
- Composer
- Node.js & NPM
- PostgreSQL / MySQL

### Steps

1. **Clone repository**
```bash
git clone https://github.com/marceljogido/digioh.git
cd digioh
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** di file `.env`
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=digioh
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate --seed
```

6. **Create storage link**
```bash
php artisan storage:link
```

7. **Build assets & run server**
```bash
npm run build
php artisan serve
```

Akses website di `http://127.0.0.1:8000`

---

## Development

### Run development server
```bash
npm run dev
php artisan serve
```

### Code Style Fix
```bash
composer pint
npm run format
```

### Clear All Cache
```bash
composer clear-all
```

### Create New Module
```bash
php artisan module:build MODULE_NAME
```

---

## Features

### Core Features
- ✅ User Authentication (Email & Social Login)
- ✅ Role-based Permissions
- ✅ Dynamic Menu System
- ✅ Multi-language Support (ID/EN)
- ✅ Dark Mode

### Content Management
- ✅ Services Management
- ✅ Portfolio (Our Work)
- ✅ Blog Posts & Categories
- ✅ FAQ Management
- ✅ Client Logos
- ✅ Team Members (Founders)
- ✅ Statistics
- ✅ Slider/Banner

### Frontend
- ✅ Responsive Design (Tailwind CSS)
- ✅ Modern UI with Glassmorphism
- ✅ SEO Optimized
- ✅ Contact Form

### Backend
- ✅ Admin Dashboard (CoreUI + Bootstrap 5)
- ✅ DataTables Integration
- ✅ File Manager
- ✅ Backup Management
- ✅ Log Viewer
- ✅ Site Settings

---

## Tech Stack

| Category | Technology |
|----------|------------|
| Backend | Laravel 12.x, PHP 8.2+ |
| Frontend | Tailwind CSS, Alpine.js |
| Admin | CoreUI, Bootstrap 5 |
| Database | PostgreSQL / MySQL |
| Auth | Laravel Breeze, Spatie Permissions |
| Others | Livewire, Vite |

---

## License

This project is proprietary software owned by **PT. Digital Open House**.

---

## Contact

- 🌐 Website: https://digioh.id
- 📧 Email: hello@digioh.id
- 📍 Location: Bandung, Indonesia
