<?php
$conn = mysqli_connect("localhost","root","","FernandaRisky");
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Beranda</title>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
<div class="container">
  <?php
  if(isset($_SESSION['login']) ){
    if ($_SESSION['login'] == 'on'){ ?>
      <!-- // echo "session login aktif"; -->
      <h1 class="text-center">Hello <?= $_SESSION['username'] ?></h1>
      <?php
      if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){ ?>
        <h1 class="text-center">login dengan session</h1>
      <?php }
      else{ ?>
        <h1 class="text-center">login tanpa session</h1>
      <?php }
      ?>
    <?php
    }
    else{
      header("Location: login.php");
    }
  }
  else{
    if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
      $_SESSION['login'] = 'on';
      $_SESSION['username'] = $_COOKIE['username'];  ?>
      <h1 class="text-center">Hello <?= $_SESSION['username'] ?></h1>
      <h1 class="text-center">login dengan session</h1>

    <?php
    }
    else{
      $_SESSION['login'] = 'off';
      header("Location: login.php");
    }
  }
  ?>
</div>



<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>