<?php 
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id']) && isset($_POST['id'])){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id'])){

    $id = trim($_GET['id']);

    $sql = "SELECT NEWS_ID,TITLE_NEWS,NEWS_DETAIL,NEWS_DATE FROM news WHERE NEWS_ID = $id";

    $res = mysqli_query($conn,$sql);
    // echo mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);

    $resultDate = date('d/m/Y',strtotime(str_replace('/', '-', $row['NEWS_DATE'] )));
    $resultTitleNews = $row['TITLE_NEWS'];
    $resultNewsDetail = $row['NEWS_DETAIL'] ;    

}

$error = false;
if(isset($_POST['btn-submit'])) {

    $id = trim($_POST['id']);
    
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

        $sql = "UPDATE news SET NEWS_DATE = '$date', TITLE_NEWS = '$title', NEWS_DETAIL = '$detail' WHERE NEWS_ID = $id";

        mysqli_query($conn,$sql);

        $msgSuccess = "Update Complete";
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
        <h3>UPDATE NEWS</h3><hr>

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
                    <input class="form-control" id="date" name="date" type="text" value="<?php if(isset($_GET['id']))  echo $resultDate ; ?>"/>
                  </div>
                </div>
                <?php if(isset($dateError))  echo '<span class="" >'. $dateError ."</span>"  ?>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="title" >TITLE : </label>            
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" name="title" placeholder="TITLE" value="<?php if(isset($_GET['id']))  echo $resultTitleNews ; ?>">
                </div>
                <?php if(isset($titleError))  echo '<span class="" >'. $titleError ."</span>"  ?>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="detail" >DATA ANNOUNCED : </label>            
                <div class="col-md-6">
                     <textarea  class="form-control" id="detail" name="detail" rows="3"><?php if(isset($_GET['id']))  echo $resultNewsDetail ; ?></textarea>              
                </div>
                <?php if(isset($detailError))  echo '<span class="" >'. $detailError ."</span>"  ?>
            </div>
            
            <input type="hidden" class="form-control" id="id" name="id" value="<?php if(isset($_GET['id']))  echo $id ; ?>">

            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit">UPDATE</button>
                    <button type="submit" class="btn btn-default" name="btn-cancle">CANCLE</button>
                </div>
            </div>

        </form>

    </div> <!-- /container -->

<script>
  $('#date').daterangepicker({
        singleDatePicker: true,        
        minDate: '<?php echo $resultDate;?>',
        locale: {
            format: 'DD/MM/YYYY'
        },        
    });
</script>
	
</body>
</html>