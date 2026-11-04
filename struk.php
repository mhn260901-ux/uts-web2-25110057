<?php
// 1. Simpan data keranjang dalam array multidimensi
$keranjang = [
    [
        "nama" => "Kopi Susu",
        "harga" => 18000,
        "jumlah" => 2
    ],
    [
        "nama" => "Teh Manis",
        "harga" => 8000,
        "jumlah" => 3
    ],
    [
        "nama" => "Roti Bakar",
        "harga" => 15000,
        "jumlah" => 1
    ]
];

// 2. Buat fungsi hitungSubtotal dan fungsi formatRupiah
function hitungSubtotal($harga, $jumlah) {
    return $harga * $jumlah;
}

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Inisialisasi total belanja awal
$total_belanja = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Belanja - Kedai Kopi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; line-height: 1.6; }
        table { border-collapse: collapse; width: 60%; margin-top: 10px; margin-bottom: 20px; }
        table, th, td { border: 1px solid #111; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .result-box { background-color: #f9f9f9; padding: 15px; border: 1px dashed #777; width: 57%; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Data Keranjang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // 3. Gunakan foreach untuk menampilkan tabel HTML
            $no = 1;
            foreach ($keranjang as $item) {
                $subtotal = hitungSubtotal($item['harga'], $item['jumlah']);
                $total_belanja += $subtotal;
                
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($item['nama']) . "</td>";
                echo "<td>" . formatRupiah($item['harga']) . "</td>";
                echo "<td>" . $item['jumlah'] . "</td>";
                echo "<td>" . formatRupiah($subtotal) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // 4. Hitung total belanja dan diskon 10%
    $diskon = 0;
    if ($total_belanja >= 50000) {
        $diskon = 0.10 * $total_belanja;
    }
    $total_bayar = $total_belanja - $diskon;
    $tanggal_hari_ini = date('d-m-Y');
    ?>

    <h3>Hasil yang Diharapkan pada struk.php</h3>
    <div class="result-box">
        <p>Tanggal Transaksi: <?php echo $tanggal_hari_ini; ?></p>
        <p>Total belanja: <?php echo formatRupiah($total_belanja); ?></p>
        <p>Diskon 10%: <?php echo formatRupiah($diskon); ?></p>
        <p>Total bayar: <?php echo formatRupiah($total_bayar); ?></p>
    </div>

    <br>
    <p><a href="form_produk.php">&raquo; Tambah Produk Baru via Form</a></p>

</body>
</html>
