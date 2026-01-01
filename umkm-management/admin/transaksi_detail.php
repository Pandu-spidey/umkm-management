<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

$id = $_GET['id'];

$t = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT t.*, u.username
   FROM transaksi t
   JOIN users u ON t.user_id = u.id
   WHERE t.id='$id'"
));

if (!$t) {
  header("Location: transaksi.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">📄 Detail Transaksi</h4>

      <table class="table table-bordered">
        <tr>
          <th width="30%">ID Transaksi</th>
          <td><?= $t['id'] ?></td>
        </tr>
        <tr>
          <th>Tanggal</th>
          <td><?= $t['tanggal'] ?></td>
        </tr>
        <tr>
          <th>Kasir</th>
          <td><?= $t['username'] ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td><b>Rp <?= number_format($t['total']) ?></b></td>
        </tr>
      </table>

      <a href="transaksi.php" class="btn btn-secondary">⬅ Kembali</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
