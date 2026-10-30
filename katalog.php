<?php
declare(strict_types=1);
require_once 'data.php';
require_once 'functions.php';

// Menangkap parameter kategori yang diklik dari URL (jika ada)
$kategoriAktif = $_GET['kategori'] ?? 'Semua';

// Daftar kategori yang tersedia untuk tombol filter
$daftarKategori = ['Semua', 'Makanan', 'Snack', 'Dessert', 'Minuman Kopi', 'Minuman Non Kopi'];

// Filter menu berdasarkan kategori yang dipilih
if ($kategoriAktif === 'Semua') {
    $menuDitampilkan = $daftarMenu;
} else {
    $menuDitampilkan = array_filter($daftarMenu, fn($item) => $item['kategori'] === $kategoriAktif);
}

// Ringkasan hitung disesuaikan dengan menu yang sedang tampil/difilter
$totalMenuTampil = count($menuDitampilkan);
$rataRataHarga = hitungRataRataHarga(array_values($menuDitampilkan));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu - Kafe Senja</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .filter-container { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem; justify-content: center; }
        .filter-btn { padding: 0.5rem 1rem; border: 1px solid #cbd5e1; background: #fff; color: #334155; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; }
        .filter-btn:hover, .filter-btn.active { background: #0284c7; color: #fff; border-color: #0284c7; }
        
        .grid-menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-top: 1rem; }
        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 9px; overflow: hidden; display: flex; flex-direction: column; }
        
        /* Perbaikan: object-fit disatukan menggunakan 'cover' dan diberi background agar rapi */
        .card img { width: 100%; height: 160px; object-fit: cover; object-position: center; background-color: #f8fafc; padding: 5px; }
        
        .card-content { padding: 1.2rem; display: flex; flex-direction: column; flex-grow: 1; }
        
        .badge { display: inline-block; padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: bold; border-radius: 4px; margin-bottom: 0.5rem; align-self: flex-start; }
        .badge-tersedia { background-color: #d1fae5; color: #065f46; }
        .badge-habis { background-color: #fee2e2; color: #991b1b; }
        
        .summary-box { background: #e0f2fe; padding: 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; color: #0369a1; border-left: 4px solid #0284c7; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
    </style>
</head>
<body>
    <header>
        <h1>☕ Kafe Senja</h1>
        <p>Daftar Menu</p>
    </header>
    <nav>
        <a href="index.php">Profil Kafe</a>
        <a href="katalog.php">Daftar Menu</a>
    </nav>
    <main>
        <!-- Tombol Filter Kategori -->
        <section>
            <h2>Pilih Kategori Menu</h2>
            <div class="filter-container">
                <?php foreach ($daftarKategori as $kat): ?>
                    <a href="katalog.php?kategori=<?= urlencode($kat) ?>" 
                       class="filter-btn <?= ($kategoriAktif === $kat) ? 'active' : '' ?>">
                        <?= $kat ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Ringkasan Hasil Hitung yang Disesuaikan -->
            <div class="summary-box">
                <div>
                    <p>Kategori Aktif: <strong><?= e($kategoriAktif) ?></strong></p>
                    <p>Jumlah Menu Ditampilkan: <strong><?= $totalMenuTampil ?> menu</strong></p>
                </div>
                <div>
                    <p>Rata-rata Harga: <strong><?= formatRupiah((int)$rataRataHarga) ?></strong></p>
                </div>
            </div>
        </section>

        <!-- Daftar Menu Berdasarkan Hasil Filter -->
        <section>
            <h2>Daftar Menu (<?= e($kategoriAktif) ?>)</h2>
            <?php if (empty($menuDitampilkan)): ?>
                <p style="text-align: center; color: #64748b; padding: 2rem;">Belum ada menu pada kategori ini.</p>
            <?php else: ?>
                <div class="grid-menu">
                    <?php foreach ($menuDitampilkan as $menu): ?>
                        <div class="card">
                            <img src="<?= e($menu['foto']) ?>" alt="Foto menu <?= e($menu['nama']) ?>">
                            <div class="card-content">
                                <?php if ($menu['tersedia']): ?>
                                    <span class="badge badge-tersedia">Tersedia</span>
                                <?php else: ?>
                                    <span class="badge badge-habis">Kosong</span>
                                <?php endif; ?>
                                <p style="font-size: 0.85rem; color: #64748b;"><?= e($menu['kategori']) ?></p>
                                <h3 style="font-size: 1.1rem; margin: 0.3rem 0;"><?= e($menu['nama']) ?></h3>
                                <p style="font-weight: bold; color: #0284c7; margin-top: auto;"><?= formatRupiah($menu['harga']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 Kafe Senja</p>
    </footer>
</body>
</html>