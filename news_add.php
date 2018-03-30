<?php 
require_once 'config/dbconfig.php';

$error = false;
if(isset($_POST['btn-submit'])) {
    
    $date = trim($_POST['date']);
    $date = date('Y-m-d', strtotime(str_replace('/', '-',$date)));
    $date = strip_tags($date);
    $date = htmlspecialchars($date);
    

    $title = trim($_POST['title']);
    $title = strip_tags($title);
    $title = htmlspecialchars($title);

    $detail = trim($_POST['detail']);
    $detail = strip_tags($detail);
    $detail = htmlspecialchars($detail);

    if(empty($date)) {
       
        $error = true;
        $dateError = "Select Date";
    }

    if(empty($title)) {

        $erroe = true;
        $titleError = "Input Title Name";
    }

    if(empty($detail)) {

        $erroe = true;
        $detailError = "Input Detail Data";
    }
    if(!$error) {

        $sql = "INSERT INTO news( NEWS_DATE, TITLE_NEWS, NEWS_DETAIL ) VALUES( '$date', '$title', '$detail' )";

        mysqli_query($conn,$sql);

        $msgSuccess = "Complete";
        $btnBack = "news.php";
        
    }

}

if (isset($_POST['btn-cancle'])) {
    
    echo "<script> window.location.href = 'news.php' </script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEWS | 1</title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>
	
	<?php include 'fragment/navbar.php'; ?>

    <div class="container">
        <h3>ADD NEWS</h3><hr>

        <?php  
            if(isset($msgSuccess)) {
                echo '<div class="alert alert-success" role="alert">';
                echo $msgSuccess ;
                echo ' Back To Before ';
                echo '<a href="'. $btnBack .'" class="alert-link" style="padding: 0 10px;"> Click </a>';
                echo '</div>';
            }

        ?>

        <form class="form-horizontal row" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

            <div class="form-group">
                <label class="control-label col-md-3 requiredField" for="date">
                    DATE : <span class="asteriskField"></span>
                </label>
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text" />
                  </div>
                </div>
                <?php if(isset($dateError))  echo '<span class="" >'. $dateError ."</span>"  ?>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="title" >TITLE : </label>            
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" name="title" placeholder="TITLE">
                </div>
                <?php if(isset($titleError))  echo '<span class="" >'. $titleError ."</span>"  ?>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="detail" >DATA ANNOUNCED : </label>            
                <div class="col-md-6">
                     <textarea  class="form-control" id="detail" name="detail" rows="3"></textarea>              
                </div>
                <?php if(isset($detailError))  echo '<span class="" >'. $detailError ."</span>"  ?>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit">SAVE</button>
                    <button type="submit" class="btn btn-default" name="btn-cancle">CANCLE</button>
                </div>
            </div>

        </form>

    </div> <!-- /container -->

<script>
  $('#date').daterangepicker({
        singleDatePicker: true,        
        minDate: new Date(),
        locale: {
            format: 'DD/MM/YYYY'
        },        
    });
</script>
	
</body>
</html>