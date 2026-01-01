<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

$data = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">📦 Data Produk</h4>

      <a href="produk_tambah.php" class="btn btn-success mb-3">+ Tambah Produk</a>

      <table class="table table-bordered table-hover align-middle">
        <tr class="table-dark text-center">
          <th>No</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>

        <?php $no=1; while($p=mysqli_fetch_assoc($data)): ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= $p['nama_produk'] ?></td>
          <td>Rp <?= number_format($p['harga']) ?></td>
          <td class="text-center">
            <span class="badge bg-info"><?= $p['stok'] ?></span>
          </td>
          <td class="text-center">
            <a href="produk_edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="produk_hapus.php?id=<?= $p['id'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Hapus produk?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>

      <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
