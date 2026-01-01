<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

$data = mysqli_query($conn,
  "SELECT t.id, t.tanggal, t.total, u.username
   FROM transaksi t
   JOIN users u ON t.user_id = u.id
   ORDER BY t.id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">🧾 Data Transaksi</h4>

      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php $no=1; while($t=mysqli_fetch_assoc($data)): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= $t['tanggal'] ?></td>
            <td><?= $t['username'] ?></td>
            <td>Rp <?= number_format($t['total']) ?></td>
            <td class="text-center">
              <a href="transaksi_detail.php?id=<?= $t['id'] ?>"
                 class="btn btn-info btn-sm">Detail</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>

      <a href="dashboard.php" class="btn btn-secondary">⬅ Dashboard</a>
      <a href="export_excel.php" class="btn btn-success">📥 Export Excel</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
