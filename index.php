<?php

require_once 'config/dbconfig.php';

$error =false;
if(isset($_POST['btn-login'])) {

  $user = trim($_POST['user']);
  $user = strip_tags($user);
  $user = htmlspecialchars($user);


  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);


  if(empty($user)) {
    $error = true;
    $userError = "Please enter your username";


  }

  if(empty($pass)){
    $error = true;
    $passError = "Please enter your password";

  }

  if(!$error) {
    $password = $pass;
    $sql = "SELECT USER_ID,USER_NAME,USER_PASS,USER_GROUP,USER_ISID FROM users WHERE USER_NAME = '$user'";
    $res = mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);



    if($count == 1 && $row['USER_PASS'] == $password) {
      $_SESSION['user'] = $row['USER_ID'];
      $_SESSION['group'] = $row['USER_GROUP'];
      $_SESSION['isid'] = $row['USER_ISID'];

      echo "<script> window.location.href = 'home.php'</script>";  //เมื่อ Login ผ่านจะเข้าหน้านี้

    } else {
      $errMSG ="Incorrect , Try againt";
    }
  }


}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

    <title>Login</title>

  </head>
  <body class="text-center">



    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> "class="form-signin">

      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <?php
          if(isset($errMSG) ) {
            echo '<div class="alert alert-danger" role="alert" style="text-align: center;"><span style="padding: 10px;">'. $errMSG .'</span></div>';
          }
      ?>
      <label for="username" class="sr-only">username</label>
      <input type="text" id="user" name="user"class="form-control" placeholder="Username" required autofocus>
      <label for="Password" class="sr-only">password</label>
      <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">

        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>

      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn-login" name="btn-login" >Sign in
          <center> <div class="ipples buttonRipples"><span class="ripplesCircle"></span></div> <center>
      </button>
      <ul></ul>
      <p class="mt-5 mb-3 text-muted">&copy; ICT.SCI.PSU. 2018</p>
    </form>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
