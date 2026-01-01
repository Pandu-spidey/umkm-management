<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

$id = $_GET['id'];

$p = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT * FROM produk WHERE id='$id'"
));

if (!$p) {
  header("Location: produk.php");
  exit;
}

if (isset($_POST['update'])) {
  $nama  = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok  = $_POST['stok'];

  mysqli_query($conn,
    "UPDATE produk SET
     nama_produk='$nama',
     harga='$harga',
     stok='$stok'
     WHERE id='$id'"
  );

  header("Location: produk.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">✏️ Edit Produk</h4>

      <form method="post">
        <div class="mb-2">
          <label>Nama Produk</label>
          <input type="text" name="nama" class="form-control"
                 value="<?= $p['nama_produk'] ?>" required>
        </div>

        <div class="mb-2">
          <label>Harga</label>
          <input type="number" name="harga" class="form-control"
                 value="<?= $p['harga'] ?>" required>
        </div>

        <div class="mb-3">
          <label>Stok</label>
          <input type="number" name="stok" class="form-control"
                 value="<?= $p['stok'] ?>" required>
        </div>

        <button name="update" class="btn btn-warning">💾 Update</button>
        <a href="produk.php" class="btn btn-secondary">⬅ Kembali</a>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
