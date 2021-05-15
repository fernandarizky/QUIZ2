<?php
$conn = mysqli_connect("localhost","root","","FernandaRisky");
session_start();
if(isset($_SESSION['login']) ){
  

  if ($_SESSION['login'] == 'on'){
    // echo "session login aktif";
    header("Location: index.php");
  }

  
}
else{
  if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $_SESSION['login'] = 'on';
    $_SESSION['username'] = $_COOKIE['username'];
    header("Location: index.php");
  }
  else{
    $_SESSION['login'] = 'off';
  }
}

if(isset($_POST['btn_submit'])){
  // var_dump($_POST);
  $input_username = $_POST['input_username'];
  $input_password = $_POST['input_password'];
  
  $query = mysqli_query($conn,"SELECT * FROM data_user WHERE username = '$input_username' and password = '$input_password'");
  
  // echo mysqli_num_rows($query);
  if(mysqli_num_rows($query)){
    if(isset($_POST['cookie_togle'])){
      // echo "login dengan cookie";
      setcookie('username',$input_username,time()+360);
      setcookie('password',$input_password,time()+360);
    
    }
    
    $_SESSION['login'] = 'on';
    $_SESSION['username'] = $input_username;
    header("Location: index.php");
  }
  else{
    echo "input login salah";
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>


<div class="container">
  <h1 class="text-center ">Login</h1>
  <center>

  <form action="" method="POST">
    <table class="table table-danger" style="width: 600px;">
      <tr>
        <td>Input username</td> <td><input type="text" class="form-control" name="input_username"></td>
      </tr>
      <tr>
        <td>Input Password</td> <td><input type="password" name="input_password" class="form-control"></td>
      </tr>
      <tr>
        <td>Cookie <input class="form-check-input" type="checkbox" value="" name="cookie_togle" id="flexCheckDefault" </td> <td><button type="submit" name="btn_submit" class="btn btn-danger">Login</button></td>
      </tr>
    </table>
  </form>
  </center>
</div>



<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>