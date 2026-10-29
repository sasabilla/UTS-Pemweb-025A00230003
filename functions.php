<?php
declare(strict_types=1);

// Fungsi buatan 1: Format angka ke Rupiah
function formatRupiah(int $angka): string {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Fungsi buatan 2: Menghitung rata-rata harga menu (memakai array_column & array_sum)
function hitungRataRataHarga(array $data): float {
    if (count($data) === 0) {
        return 0.0;
    }
    $semuaHarga = array_column($data, 'harga');
    $totalHarga = array_sum($semuaHarga);
    
    return $totalHarga / count($data);
}

// Fungsi pembungkus keamanan output
function e(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}