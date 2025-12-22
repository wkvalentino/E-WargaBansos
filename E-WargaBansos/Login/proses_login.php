<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM petugas 
        WHERE username='$username' AND password='$password'";
$res = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($res) == 1){
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("Location: ../dashboard.php");
    exit;
} else {
    echo "Login gagal";
}
