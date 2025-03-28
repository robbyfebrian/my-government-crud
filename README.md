# My Government CRUD

**My Government CRUD** adalah aplikasi berbasis web yang dibangun menggunakan **Laravel** dan **Filament**. Aplikasi ini dirancang untuk mengelola data surat masuk dengan berbagai fitur, termasuk klasifikasi surat, status penyelesaian, dan unduhan PDF.

## ✨ Fitur Utama

✅ **Manajemen Surat**: CRUD (Create, Read, Update, Delete) untuk surat masuk.  
✅ **Klasifikasi Surat**: Surat dapat dikategorikan berdasarkan jenisnya.  
✅ **Status Penyelesaian**: Tandai surat sebagai **selesai** atau **belum diproses**.  
✅ **Unduhan PDF**: Cetak surat dalam format PDF.  
✅ **Statistik & Grafik**: Analisis data surat dengan **pie chart & line chart**.  

## 📌 Persyaratan Sistem

Sebelum menjalankan aplikasi ini, pastikan sistem Anda telah memenuhi persyaratan berikut:

- PHP **^8.1**
- Composer **latest**
- Node.js & npm **(untuk build frontend)**
- Database **MySQL / PostgreSQL / SQLite**
- Laravel **^10**
- Filament Admin **^3**

## 🚀 Instalasi & Konfigurasi

### **1️⃣ Clone Repositori**
```
bash
git clone <repository-url>
cd my-government-crud
```

### **2️⃣ Install Dependensi**
```
composer install
npm install && npm run build
```

### **3️⃣ Konfigurasi Environment**
Salin file .env.example menjadi .env, lalu atur koneksi database:
```
cp .env.example .env
```

Edit .env dan sesuaikan bagian berikut:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_government_crud
DB_USERNAME=root
DB_PASSWORD=
```

### **4️⃣ Generate Key & Jalankan Migrasi**
```
php artisan migrate --seed
```

### **5️⃣ Jalankan Server**
```
php artisan serve
```

## 📊 Statistik & Grafik

Aplikasi ini menggunakan Filament Charts untuk menampilkan data dalam bentuk grafik interaktif, termasuk:
- 📈 Line Chart: Jumlah surat masuk setiap bulan.
- 🥧 Pie Chart: Proporsi kategori surat.

## 📜 Manajemen Surat (CRUD)

### 🔹 Menambahkan Surat
- Buka Filament Panel
- Navigasi ke “Surat Masuk”.
- Klik Tambah Surat.
- Isi data dan simpan.

### 🔹 Mengedit & Menghapus Surat
- Gunakan tombol Edit untuk memperbarui informasi.
- Gunakan tombol Hapus untuk menghapus surat.

## 📥 Unduh Surat dalam PDF
Aplikasi ini mendukung konversi surat ke PDF dengan tombol “Download PDF”.
Surat yang diunduh otomatis diberi nama sesuai format:
```
surat-tanda-terima-[nama_surat].pdf
```

## 👤 Manajemen Pengguna
Aplikasi ini memiliki fitur autentikasi berbasis Filament:
- Admin: Memiliki akses CRUD dan menambahkan User.
- User: Dapat melakukan CRUD.

## 🔑 Default Login Admin:
```
Email: admin@admin.com
Password: admin
```
