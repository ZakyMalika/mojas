# MOJAS - Sistem Manajemen Antar Jemput Anak Sekolah

MOJAS adalah aplikasi web berbasis Laravel 12 yang dirancang untuk mengelola layanan antar-jemput anak sekolah. Sistem ini menghubungkan orang tua, pengemudi, dan admin dalam satu platform terintegrasi.

## 🚀 Fitur Utama

### 👨‍💼 Panel Admin
- **Dashboard Admin** - Overview lengkap sistem
- **Manajemen Orang Tua** - Kelola data orang tua
- **Manajemen Anak** - Kelola data anak-anak
- **Manajemen Driver** - Kelola data pengemudi
- **Tarif & Jarak** - Atur tarif berdasarkan jarak
- **Pendaftaran Anak** - Kelola pendaftaran layanan
- **Pembayaran** - Manajemen pembayaran
- **Jadwal Antar Jemput** - Atur jadwal perjalanan
- **Log Jadwal** - Riwayat perjalanan
- **Penghasilan Driver** - Kelola penghasilan pengemudi

### 👨‍👩‍👧‍👦 Panel Orang Tua
- **Dashboard Orang Tua** - Overview aktivitas anak
- **Data Anak** - Kelola informasi anak
- **Pendaftaran Anak** - Daftar layanan antar-jemput
- **Pembayaran** - Kelola pembayaran layanan

### 🚗 Panel Pengemudi
- **Dashboard Driver** - Overview jadwal dan penghasilan
- **Jadwal Antar Jemput** - Lihat jadwal perjalanan
- **Log Jadwal** - Catat perjalanan yang telah dilakukan
- **Penghasilan** - Lihat detail penghasilan

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12.x
- **PHP**: ^8.2
- **Frontend**: Blade Templates, TailwindCSS 4.0, Vite
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Testing**: Pest Framework
- **UI Enhancement**: SweetAlert2
- **Queue System**: Laravel Queue
- **Development Tools**: Laravel Pint, Laravel Sail

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL (opsional)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url> mojas
cd mojas
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database
```bash
# Buat database SQLite (jika menggunakan SQLite)
touch database/database.sqlite

# Jalankan migrasi
php artisan migrate

# Seed data (opsional)
php artisan db:seed
```

### 5. Build Assets
```bash
npm run build
```

## 🏃‍♂️ Menjalankan Aplikasi

### Development Mode
```bash
# Jalankan semua service sekaligus (server, queue, vite)
composer run dev
```

Atau jalankan secara terpisah:

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Queue worker
php artisan queue:listen --tries=1

# Terminal 3: Vite dev server
npm run dev
```

### Production Mode
```bash
# Build assets untuk production
npm run build

# Jalankan server
php artisan serve
```

## 👥 Roles & Permissions

Sistem memiliki 3 role utama:

1. **Admin** (`admin`)
   - Akses penuh ke seluruh sistem
   - URL: `/admin`

2. **Orang Tua** (`orang_tua`) 
   - Kelola data anak dan pembayaran
   - URL: `/parent`

3. **Pengemudi** (`pengemudi`)
   - Kelola jadwal dan penghasilan
   - URL: `/driver`

## 🧪 Testing

```bash
# Jalankan semua test
composer run test

# Atau menggunakan artisan
php artisan test
```

## 📁 Struktur Database

### Tabel Utama:
- `users` - Data pengguna sistem
- `orang_tua` - Data orang tua
- `drivers` - Data pengemudi
- `anak` - Data anak-anak
- `jadwal_antar_jemput` - Jadwal perjalanan
- `tarif_jarak` - Tarif berdasarkan jarak
- `pendaftaran_anak` - Pendaftaran layanan
- `pembayaran` - Data pembayaran
- `penghasilan_drivers` - Penghasilan pengemudi
- `log_jadwal` - Log perjalanan

## 🔧 Konfigurasi

### Environment Variables
```env
# Database
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

# Mail (untuk notifikasi)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025

# Queue (untuk background jobs)
QUEUE_CONNECTION=database
```

### Middleware Custom
- `RoleMiddleware` - Mengatur akses berdasarkan role pengguna
- `RedirectIfAuthenticated` - Redirect user yang sudah login

## 📚 API Endpoints

### Authentication
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman registrasi
- `POST /register` - Proses registrasi
- `POST /logout` - Logout

### AJAX Validation
- `POST /check-username` - Validasi username
- `POST /check-email` - Validasi email
- `POST /check-phone` - Validasi nomor telepon

### Admin Routes (Prefix: `/admin`)
- CRUD untuk semua entitas sistem
- Route khusus untuk penghasilan driver

### Parent Routes (Prefix: `/parent`)
- Manajemen anak dan pembayaran

### Driver Routes (Prefix: `/driver`)
- Manajemen jadwal dan penghasilan

## 🤝 Kontribusi

1. Fork repository
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.

## 🐛 Bug Reports & Feature Requests

Untuk melaporkan bug atau meminta fitur baru, silakan buat issue di repository ini.

## 📞 Support

Jika Anda memerlukan bantuan, silakan hubungi:
- Email: [your-email@example.com]
- GitHub Issues: [repository-url/issues]

---

**MOJAS** - Making school transportation management easier! 🚌✨
