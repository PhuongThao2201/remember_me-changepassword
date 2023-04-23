<?php
require_once "connect.php";
 $erros =[];
 if (isset($_POST['login'])){
  $email= $_POST['Email'];
  $Pass = $_POST['Password'];
   if (empty ($email)){
      $erros[] = "Email is required";
   }
   if (empty ($Pass)){
      $erros[] = "Password is required";
   }
   if (count($erros)== 0){
  $Password_hash = sha1($Pass);
  $sql = "select * from users where  email = '$email'and password = '$Password_hash'";
  $res = $conn ->  query ($sql);
  if($res -> num_rows > 0 ){
      echo" Login succesfully";
      header('Location: index.php');
      die ();
  }
  else{
      $erros[]="Incorrect account or password";
  }
   }
}
if(isset($_POST['rememberme'])) {
    setcookie('Email', $email, time() + 3600); 
}
if(isset($_COOKIE['Email'])) {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <title>Login</title>
</head>

<body>
  <div class="wrapper">
    <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
    <div class="form-box login">
      <h2>Login</h2>
      <form action="#" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail-outline"></ion-icon> Email</span>
          <input type="email" name = "Email" required>
          <label for="Email"></label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
          <input type="password" name = "Password"required>
          <label for="Password"></label>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" name = "rememberme">Remember me</label>
          <a href="#">Forgot Password</a>
        </div>
        <button type="submit" name = "login" class="btn">Login</button>
      </form>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>