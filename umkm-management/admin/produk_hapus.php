<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'admin') exit;

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

header("Location: produk.php");
exit;
