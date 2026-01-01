<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'kasir') {
  header("Location: ../auth/login.php");
  exit;
}

// statistik kasir
$hari_ini = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT COUNT(*) total 
   FROM transaksi 
   WHERE DATE(tanggal) = CURDATE() 
   AND user_id = '$_SESSION[id]'"
))['total'];

$total = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT SUM(total) total 
   FROM transaksi 
   WHERE user_id='$_SESSION[id]'"
))['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Kasir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

  <h3>Dashboard Kasir</h3>
  <p>Halo, <b><?= $_SESSION['username'] ?></b></p>

  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card text-bg-primary shadow">
        <div class="card-body">
          <h6>Transaksi Hari Ini</h6>
          <h2><?= $hari_ini ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-bg-success shadow">
        <div class="card-body">
          <h6>Total Penjualan</h6>
          <h4>Rp <?= number_format($total) ?></h4>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <h5>Menu Kasir</h5>
      <a href="transaksi.php" class="btn btn-primary">🧾 Transaksi</a>
      <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
