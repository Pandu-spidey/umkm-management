<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

// statistik
$produk = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT COUNT(*) total FROM produk"
))['total'];

$transaksi = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT COUNT(*) total FROM transaksi"
))['total'];

$pendapatan = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT SUM(total) total FROM transaksi"
))['total'] ?? 0;

// transaksi terakhir
$last = mysqli_query($conn,
  "SELECT t.tanggal, t.total, u.username
   FROM transaksi t
   JOIN users u ON t.user_id = u.id
   ORDER BY t.id DESC
   LIMIT 5"
);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h2>Dashboard Admin</h2>
<p>Halo, <b><?= $_SESSION['username'] ?></b></p>

<hr>

<div class="container mt-4">
  <h3 class="mb-3">Dashboard Admin</h3>
  <p>Halo, <b><?= $_SESSION['username'] ?></b></p>

  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card text-bg-primary shadow">
        <div class="card-body">
          <h6>Produk</h6>
          <h2><?= $produk ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-bg-success shadow">
        <div class="card-body">
          <h6>Transaksi</h6>
          <h2><?= $transaksi ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-bg-warning shadow">
        <div class="card-body">
          <h6>Pendapatan</h6>
          <h4>Rp <?= number_format($pendapatan) ?></h4>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <h5>Transaksi Terakhir</h5>

      <table class="table table-bordered table-hover">
        <tr>
          <th>Tanggal</th>
          <th>Kasir</th>
          <th>Total</th>
        </tr>
        <?php while($r=mysqli_fetch_assoc($last)): ?>
        <tr>
          <td><?= $r['tanggal'] ?></td>
          <td><?= $r['username'] ?></td>
          <td>Rp <?= number_format($r['total']) ?></td>
        </tr>
        <?php endwhile ?>
      </table>
    </div>
  </div>

  <div class="mt-3">
    <a href="produk.php" class="btn btn-primary">📦 Produk</a>
    <a href="transaksi.php" class="btn btn-secondary">🧾 Transaksi</a>
    <a href="export_excel.php" class="btn btn-success">
  <i class="bi bi-file-earmark-excel"></i> Export Excel
</a>
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
