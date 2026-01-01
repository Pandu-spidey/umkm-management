# Aplikasi Kasir Berbasis Web (PHP & MySQL)

Aplikasi kasir sederhana berbasis web menggunakan PHP dan MySQL.
Mendukung multi-role (Admin & Kasir) dengan fitur CRUD produk, transaksi,
dashboard, dan export laporan ke Excel.

## Fitur
- Login Admin & Kasir
- Dashboard Admin & Kasir
- CRUD Produk
- Transaksi Kasir (stok otomatis berkurang)
- Riwayat Transaksi
- Export Laporan ke Excel
- UI menggunakan Bootstrap 5

## Teknologi
- PHP Native
- MySQL
- Bootstrap 5
- HTML & CSS

## Role
### Admin
- Kelola produk
- Melihat transaksi
- Export laporan Excel

### Kasir
- Input transaksi
- Melihat ringkasan penjualan

## Cara Instalasi
1. Clone repository
2. Import database `kasir_db.sql` ke phpMyAdmin
3. Jalankan di localhost (XAMPP / Laragon)
4. Akses `auth/login.php`

## Akun Default
Admin  
- username: admin  
- password: admin123  

Kasir  
- username: kasir  
- password: kasir123  

## Catatan
Project ini dibuat untuk keperluan pembelajaran dan tugas kuliah.
