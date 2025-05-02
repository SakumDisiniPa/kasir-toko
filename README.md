# Website Kasir Toko

Website Kasir Toko adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk membantu mengelola penjualan, stok barang, transaksi, serta laporan penjualan secara efisien. Cocok digunakan untuk toko retail, warung, minimarket, dan usaha kecil lainnya.

## 🔧 Fitur Utama

- ✅ Manajemen Produk (CRUD barang)
- ✅ Kategori Produk
- ✅ Stok dan Inventori
- ✅ Transaksi Penjualan (Kasir)
- ✅ Cetak Struk (PDF/Printer)
- ✅ Laporan Penjualan Harian, Bulanan, Tahunan
- ✅ Manajemen Pengguna (Admin & Petugas/Kasir)
- ✅ Otentikasi dan Hak Akses

## 📦 Teknologi

- Laravel 10.x
- MySQL / MariaDB
- Blade Template Engine
- Tailwind CSS / Bootstrap (opsional)
- DomPDF / Laravel Snappy (untuk cetak struk)
- Laravel Breeze / Fortify (untuk auth)

## ⚙️ Instalasi

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/SakumDisiniPa/kasir-toko.git
   cd kasir-laravel
```

2. **Install dependencies:**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Copy file environment:**

   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi database di file `.env`**

5. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

6. **Migrasi dan seeder database:**

   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan aplikasi:**

   ```bash
   php artisan serve
   ```

## 💻 Demo

Kamu bisa mencoba versi demo aplikasi ini secara langsung di:

👉 **[kasir.sakum.my.id](https://kasir.sakum.my.id)**

### 🔐 Akun Demo

| Role    | Email   | Password   |
| ------- | --------| ---------- |
| Admin   | admin   | `password` |
| Petugas | petugas | `password` |

**Catatan:** Password untuk kedua akun demo sama: `password`

## 📁 Struktur Folder Penting

* `app/Models` – Model data
* `app/Http/Controllers` – Logika backend
* `resources/views` – Template Blade
* `routes/web.php` – Routing utama

## ✅ Roadmap (Opsional)

* [ ] Integrasi barcode scanner
* [ ] Support multi cabang
* [ ] Modul pembelian & supplier

## 🛠 Kontribusi

Pull request sangat diterima! Untuk perubahan besar, harap buka issue terlebih dahulu agar bisa didiskusikan bersama.

## 📄 Lisensi

Proyek ini dilisensikan di bawah MIT License.

