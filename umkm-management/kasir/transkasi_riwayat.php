<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'kasir') exit;

$uid = $_SESSION['user_id'];

$data = mysqli_query($conn, "
  SELECT id, tanggal, total
  FROM transaksi
  WHERE user_id='$uid'
  ORDER BY id DESC
");
?>

<h2>Riwayat Transaksi Saya</h2>

<table border="1" cellpadding="8">
<tr>
  <th>ID</th>
  <th>Tanggal</th>
  <th>Total</th>
  <th>Detail</th>
</tr>

<?php while($t=mysqli_fetch_assoc($data)): ?>
<tr>
  <td><?= $t['id'] ?></td>
  <td><?= $t['tanggal'] ?></td>
  <td>Rp <?= number_format($t['total']) ?></td>
  <td>
    <a href="../admin/transaksi_detail.php?id=<?= $t['id'] ?>">Lihat</a>
  </td>
</tr>
<?php endwhile ?>
</table>

<br>
<a href="dashboard.php">⬅ Kembali</a>
