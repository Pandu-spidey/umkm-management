<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'kasir') {
  header("Location: ../auth/login.php");
  exit;
}

$produk = mysqli_query($conn, "SELECT * FROM produk");

if (isset($_POST['simpan'])) {
  $produk_id = $_POST['produk_id'];
  $jumlah = $_POST['jumlah'];

  $p = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT harga, stok FROM produk WHERE id='$produk_id'"
  ));

  if ($jumlah > $p['stok']) {
    echo "<script>alert('Stok tidak cukup');</script>";
  } else {

    $total = $p['harga'] * $jumlah;
    $sisa_stok = $p['stok'] - $jumlah;

    mysqli_query($conn,
      "INSERT INTO transaksi (user_id, tanggal, total)
       VALUES ('$_SESSION[id]', NOW(), '$total')"
    );

    mysqli_query($conn,
      "UPDATE produk SET stok='$sisa_stok' WHERE id='$produk_id'"
    );

    echo "<script>alert('Transaksi berhasil');location='transaksi.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Kasir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">🧾 Transaksi Kasir</h4>

      <form method="post">
        <div class="mb-2">
          <label>Produk</label>
          <select name="produk_id" class="form-select" required>
            <option value="">-- Pilih Produk --</option>
            <?php while($p=mysqli_fetch_assoc($produk)): ?>
              <option value="<?= $p['id'] ?>">
                <?= $p['nama_produk'] ?> - Rp <?= number_format($p['harga']) ?>
              </option>
            <?php endwhile ?>
          </select>
        </div>

        <div class="mb-3">
          <label>jumlah</label>
          <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>

        <button name="simpan" class="btn btn-primary">💾 Simpan Transaksi</button>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Dashboard</a>
<a href="../auth/logout.php" class="btn btn-danger">Logout</a>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
