<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

if (isset($_POST['simpan'])) {
  $nama  = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok  = $_POST['stok'];

  mysqli_query($conn,
    "INSERT INTO produk (nama_produk, harga, stok)
     VALUES ('$nama','$harga','$stok')"
  );

  header("Location: produk.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">➕ Tambah Produk</h4>

      <form method="post">
        <div class="mb-2">
          <label>Nama Produk</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Harga</label>
          <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Stok</label>
          <input type="number" name="stok" class="form-control" required>
        </div>

        <button name="simpan" class="btn btn-success">💾 Simpan</button>
        <a href="produk.php" class="btn btn-secondary">⬅ Batal</a>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
