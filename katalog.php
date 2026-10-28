<?php
declare(strict_types=1);
require_once 'data.php';
require_once 'functions.php';

// Memakai fungsi array bawaan: count(), array_filter(), reset()
$totalMenu = count($daftarMenu);
$rataRata = hitungRataRataHarga($daftarMenu);

// Memisah array data menjadi Minuman dan Makanan (Menggunakan array_filter)
$menuMinuman = array_filter($daftarMenu, fn($item) =>$item['kategori'] === 'Minuman');
$menuMakanan = array_filter($daftarMenu, fn($item) =>$item['kategori'] !== 'Minuman');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu - Kopi & Senja Kafe</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .grid-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.08);
        }
        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        .card-content {
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 0.5rem;
            align-self: flex-start;
        }
        .badge-tersedia { background-color: #d1fae5; color: #065f46; }
        .badge-habis { background-color: #fee2e2; color: #991b1b; }
        .summary-box {
            background: #e0f2fe;
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            color: #0369a1;
            font-weight: 500;
            border-left: 4px solid #0284c7;
        }
        .section-title {
            margin-top: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
            color: #0f172a;
        }
    </style>
</head>
<body>
    <header>
        <h1>☕ Kopi & Senja Kafe</h1>
        <p>Katalog Pilihan Menu Spesial Hari Ini</p>
    </header>
    
    <nav>
        <a href="index.php">Profil Kafe</a>
        <a href="katalog.php">Daftar Menu</a>
    </nav>

    <main>
        <section>
            <h2>Ringkasan Hasil Hitung</h2>
            <div class="summary-box">
                <p>Total Pilihan Menu: <strong><?= $totalMenu ?> menu</strong></p>
                <p>Rata-rata Harga Menu: <strong><?= formatRupiah((int)$rataRata) ?></strong></p>
            </div>
        </section>

        <!-- SECTION 1: MINUMAN (DI ATAS) -->
        <section>
            <h2 class="section-title">🥤 Menu Minuman</h2>
            <div class="grid-menu">
                <?php foreach ($menuMinuman as$menu): ?>
                    <div class="card">
                        <img src="<?= e($menu['foto']) ?>" alt="Foto menu <?= e($menu['nama']) ?>">
                        
                        <div class="card-content">
                            <?php if ($menu['tersedia']): ?>
                                <span class="badge badge-tersedia">Tersedia</span>
                            <?php else: ?>
                                <span class="badge badge-habis">Habis</span>
                            <?php endif; ?>

                            <p style="font-size: 0.85rem; color: #64748b; text-transform: uppercase;"><?= e($menu['kategori']) ?></p>
                            <h3 style="font-size: 1.1rem; margin: 0.3rem 0; color: #0f172a;"><?= e($menu['nama']) ?></h3>
                            <p style="font-weight: bold; color: #0284c7; margin-bottom: 0.8rem; font-size: 1.05rem;"><?= formatRupiah($menu['harga']) ?></p>
                            
                            <p style="font-size: 0.85rem; margin-top: auto; color: #475569;">
                                Rasa: ☕ Segar / Nikmat
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- SECTION 2: MAKANAN & CAMILAN (DI BAWAH) -->
        <section>
            <h2 class="section-title">🍽️ Menu Makanan & Camilan</h2>
            <div class="grid-menu">
                <?php foreach ($menuMakanan as$menu): ?>
                    <div class="card">
                        <img src="<?= e($menu['foto']) ?>" alt="Foto menu <?= e($menu['nama']) ?>">
                        
                        <div class="card-content">
                            <?php if ($menu['tersedia']): ?>
                                <span class="badge badge-tersedia">Tersedia</span>
                            <?php else: ?>
                                <span class="badge badge-habis">Habis</span>
                            <?php endif; ?>

                            <p style="font-size: 0.85rem; color: #64748b; text-transform: uppercase;"><?= e($menu['kategori']) ?></p>
                            <h3 style="font-size: 1.1rem; margin: 0.3rem 0; color: #0f172a;"><?= e($menu['nama']) ?></h3>
                            <p style="font-weight: bold; color: #0284c7; margin-bottom: 0.8rem; font-size: 1.05rem;"><?= formatRupiah($menu['harga']) ?></p>
                            
                            <!-- Pengecekan Level Pedas (Hanya untuk Makanan yang Pedas) -->
                            <?php if (isset($menu['pedas'])): ?>
                                <p style="font-size: 0.85rem; margin-top: auto; color: #475569;">
                                    Level Pedas: 
                                    <?php 
                                    echo match($menu['pedas']) {
                                        1, 2 => '🟡 Sedang',
                                        3, 4 => '🔥 Super Pedas',
                                        default => '🌶️ Pedas'
                                    };
                                    ?>
                                </p>
                            <?php else: ?>
                                <p style="font-size: 0.85rem; margin-top: auto; color: #475569;">
                                    Rasa: 🟢 Non-Pedas
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;