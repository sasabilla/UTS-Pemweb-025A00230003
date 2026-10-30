<b>1. Identitas</b>
    - Nama: Sabilla Istiqomah
    - NIM: 025A00230003
    - Kelas: 
    - Program Studi: Informatika
    - Mata Kuliah: Pemrograman Web
2. Deskripsi projek
    project website sederhana berbasis PHP yang 
    menampilkan informasi dan katalog menu kafe. Project ini dibuat untuk
    menerapkan dasar pemrograman PHP, pengelolaan data menu, serta penggunaan fungsi untuk membantu menampilkan dan mengolah data. Sistem ini menyajikan profil resmi kafe serta katalog menu yang dikelompokkan ke dalam 5 kategori: Makanan, Snack, Dessert, Minuman Kopi, dan Minuman Non Kopi. Website dilengkapi dengan fitur filter interaktif per kategori serta perhitungan statistik ringkasan harga secara dinamis.

3. cara Menjalankan Project di Local host
    1. Pastikan server lokal Anda (Laragon atau XAMPP) sudah aktif
    2. Letakkan folder repositori ini ke dalam direktori *root* server (`C:\laragon\www\` atau `C:\xampp\htdocs\`)
    3. Buka peramban web (*browser*) dan akses URL berikut:
   `http://localhost/uts-pemweb-025a00230003/index.php`


4. Daftar fitur beserta file dan nama fungsi yang digunakan
    1. Halaman Profil & Navigasi antar halaman
      - file = `index.php`, `style.css`
      - Fungsi Menampilakn informasi profil kafe, jam operasional, lokasi dan menu navigasi semantik menggunakan elemen HTML5 (`<header>`, `<nav>`, `<main>`, `<section>`, `<footer>` )
    2. Katalog menu interaktif & pemisah kategori
        - File `katalog.php`
        - Fungsi menangkap yang di klik kategori dari URL, (`$_GET['kategori']`), memfilter data menu menggunakan perulangan `foreach`, serta merender kartu menu secara dinamis.
    3. Ringkasan Hasil Hitung
        - File `functions.php`, `katalog.php`
        - Fungsi Menggunakan fungsi buatan `formatRupiah()` dan `hitungRataHarga()` untuk menghitug btotal menu tampil dan rata - rata harga
        

5. Daftar fungsi array bawaan yang dipakai dan untuk apa
6. Tangkapan layar
7. Sumber referensi dan catatan pemakaian Ai 