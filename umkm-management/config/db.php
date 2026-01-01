<?php
$conn = mysqli_connect("localhost", "root", "", "umkm_management");

if (!$conn) {
  die("Koneksi database gagal");
}
