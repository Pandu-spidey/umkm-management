<?php
session_start();

if (!isset($_SESSION['role'])) {
  header("Location: auth/login.php");
} else {
  if ($_SESSION['role'] == 'admin') {
    header("Location: admin/dashboard.php");
  } else {
    header("Location: kasir/dashboard.php");
  }
}
exit;
