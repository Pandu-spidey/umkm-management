<?php
session_start();
include '../config/db.php';

if (isset($_POST['login'])) {
  $u = $_POST['username'];
  $p = $_POST['password'];

  $q = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$u' AND password='$p'"
  );

  if (mysqli_num_rows($q) == 1) {
    $d = mysqli_fetch_assoc($q);

    $_SESSION['id'] = $d['id'];
    $_SESSION['username'] = $d['username'];
    $_SESSION['role'] = $d['role'];

    if ($d['role'] == 'admin')
      header("Location: ../admin/dashboard.php");
    else
      header("Location: ../kasir/dashboard.php");
  } else {
    echo "<script>alert('Login gagal');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow" style="width:350px">
    <div class="card-body">
      <h4 class="text-center mb-3">🔐 Login</h4>

      <form method="post">
        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button name="login" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
