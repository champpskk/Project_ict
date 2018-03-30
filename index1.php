


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

      echo "<script> window.location.href = 'home.php'</script>";

    } else {
      $errMSG ="Incorrect , Try againt";
    }
  }


}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login</title>


      <link rel="stylesheet" href="css/style_1.css">


   </head>

  <body>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index1.php"><img src="img/test-logo15.png" width="50%"></a>
            </div>
            <center>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li class="active">
                        <a href="#">Link</a>
                        </li>
                        <li><a href="#">link</a>
                        </li>
                        <li><a href="#">Link</a>
                        </li>
                        <li><a href="#">Link</a>
                        </li>
                        <li><a href="#">Link</a>
                        </li>

                            </ul>
                        </li>
                    </ul>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id ="user" name="user" placeholder="Username">
                            <span class="text-danger"></span>
                            <!-- <div class="alert alert-danger" role="alert"><?php echo $userError; ?></div> -->


                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-default" id="btn-login" name="btn-login" >Sign In
                                <!-- <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div> -->
                        </button>

                    </form>
                </div>
            </center>
        </div>
    </div>
    <hgroup>

   <h3>UNDERGRADUATE PROJECT DATA MANAGEMENT SYSTEM CASE STUDY ICT PROGRAMME.</h3>
  <!-- <h3>ระบบการจัดการข้อมูลโครงงานนิพนธ์นักศึกษาปริญญาตรีกรณีศึกษาสาขาเทคโนโลยีสารสนเทศและการสื่อสาร</h3> -->
</hgroup>



  </body>
</html>
