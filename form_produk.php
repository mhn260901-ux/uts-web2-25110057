<?php
// Inisialisasi variabel penampung data input dan pesan error
$nama_produk = '';
$harga_produk = '';
$jumlah_pesanan = ''; // Tambahan variabel baru
$errors = [
    'nama' => '',
    'harga' => '',
    'jumlah' => '' // Tambahan error bag baru
];
$sukses_pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari global variable $_POST dan bersihkan space kosong
    $nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
    $harga_produk = isset($_POST['harga_produk']) ? trim($_POST['harga_produk']) : '';
    $jumlah_pesanan = isset($_POST['jumlah_pesanan']) ? trim($_POST['jumlah_pesanan']) : '';

    // Validasi input: nama produk wajib diisi
    if (empty($nama_produk)) {
        $errors['nama'] = "Nama produk wajib diisi!";
    }

    // Validasi input: harga harus berupa angka lebih dari 0
    if (empty($harga_produk)) {
        $errors['harga'] = "Harga wajib diisi!";
    } elseif (!is_numeric($harga_produk) || $harga_produk <= 0) {
        $errors['harga'] = "Harga harus berupa angka lebih dari 0!";
    }

    // Validasi input: jumlah pesanan harus berupa angka bulat minimal 1
    if (empty($jumlah_pesanan)) {
        $errors['jumlah'] = "Jumlah pesanan wajib diisi!";
    } elseif (!filter_var($jumlah_pesanan, FILTER_VALIDATE_INT) || $jumlah_pesanan <= 0) {
        $errors['jumlah'] = "Jumlah pesanan harus berupa angka bulat minimal 1!";
    }

    // Jika semua validasi lolos tanpa error
    if (empty($errors['nama']) && empty($errors['harga']) && empty($errors['jumlah'])) {
        // Hitung total harga otomatis
        $total_harga = $harga_produk * $jumlah_pesanan;

        $sukses_pesan = "Produk <strong>" . htmlspecialchars($nama_produk) . "</strong> " .
                        "(" . htmlspecialchars($jumlah_pesanan) . " pcs) berhasil ditambahkan! " .
                        "Total Harga: <strong>Rp " . number_format($total_harga, 0, ',', '.') . "</strong>";
        
        // Kosongkan form setelah sukses
        $nama_produk = '';
        $harga_produk = '';
        $jumlah_pesanan = '';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Produk</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; line-height: 1.6; }
        .form-container { width: 350px; background-color: #fdfdfd; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .error-msg { color: red; font-size: 13px; margin-top: 5px; display: block; }
        .success-box { background-color: #e6f4ea; color: #137333; padding: 12px; border: 1px solid #137333; margin-bottom: 15px; border-radius: 4px; }
        button { background-color: #0056b3; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; font-size: 14px; }
        button:hover { background-color: #004085; }
    </style>
</head>
<body>

<h2>Bagian B — form_produk.php</h2>

<!-- Tempat menampilkan alert sukses aman XSS -->
<?php if (!empty($sukses_pesan)): ?>
    <div class="success-box">
        <?php echo $sukses_pesan; ?>
    </div>
<?php endif; ?>

<div class="form-container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($nama_produk); ?>">
            <?php if (!empty($errors['nama'])): ?>
                <span class="error-msg"><?php echo $errors['nama']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="harga_produk">Harga Produk</label>
            <input type="text" id="harga_produk" name="harga_produk" value="<?php echo htmlspecialchars($harga_produk); ?>">
            <?php if (!empty($errors['harga'])): ?>
                <span class="error-msg"><?php echo $errors['harga']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Input Baru: Jumlah Pesanan -->
        <div class="form-group">
            <label for="jumlah_pesanan">Jumlah Pesanan</label>
            <input type="text" id="jumlah_pesanan" name="jumlah_pesanan" value="<?php echo htmlspecialchars($jumlah_pesanan); ?>">
            <?php if (!empty($errors['jumlah'])): ?>
                <span class="error-msg"><?php echo $errors['jumlah']; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>

<br>
<p><a href="struk.php">&laquo; Kembali ke Halaman Struk Belanja</a></p>

</body>
</html>
