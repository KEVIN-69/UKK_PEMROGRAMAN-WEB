<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
    <title>Toko Buku Cemerlang</title>
    <link rel="stylesheet" href="css/login.css?v=1.0">
  </head>
  <body>
    <?php
 if(isset($_GET['pesan'])){
  if($_GET['pesan']=="gagal"){
   echo "<div class='alert'>Username dan Password Salah !</div>";
  }
 }
 ?>
    <div class="center"><br>
        <center>
            <img src="logo.png">
        </center>
        
      <h1>Login</h1>
      <form method="post" action="cek_login.php">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login"><br><br>
      </form>
    </div>

  </body>
</html>