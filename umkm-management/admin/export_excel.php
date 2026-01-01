<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_transaksi.xls");

$q = mysqli_query($conn,
  "SELECT t.id, t.tanggal, t.total, u.username
   FROM transaksi t
   JOIN users u ON t.user_id = u.id
   ORDER BY t.id DESC"
);
?>

<table border="1">
  <tr>
    <th colspan="4"><b>LAPORAN TRANSAKSI</b></th>
  </tr>
  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Kasir</th>
    <th>Total</th>
  </tr>

<?php while($r=mysqli_fetch_assoc($q)): ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['tanggal'] ?></td>
    <td><?= $r['username'] ?></td>
    <td><?= $r['total'] ?></td>
  </tr>
<?php endwhile; ?>
</table>
