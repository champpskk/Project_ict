<?php 
require_once 'config/dbconfig.php';

if(isset($_GET['id']) && isset($_GET['event'])) {
	$ac_id = $_GET['id'];
	$event_id = $_GET['event'];

	$sql = "SELECT EVENT_ID, EVENT_TITLE FROM events WHERE EVENT_ID =".$event_id;
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$eventTitle = $row['EVENT_TITLE'];

	$sql1 = "SELECT AC_ID,AC_STATUS,AC_COMMENT,DATE_COMMENT,TIME_COMMENT FROM sent_activity WHERE AC_ID = ".$ac_id;

	$res = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_assoc($res);


	$ac_id = $row['AC_ID'];
	$dateComment = $row['DATE_COMMENT'];
	$timeComment = $row['TIME_COMMENT'];
	$comment = $row['AC_COMMENT'];
	
	if($dateComment == "0000-00-00"){
		$dateShow = 'Time Error';
	}else{
		$dateComment = date('d/m/Y', strtotime(str_replace('/', '-',$dateComment)));
		$dateComment = date('l , d F Y', strtotime(str_replace('/', '-',$dateComment)));				         
		$timeComment = date('h:i A', strtotime(str_replace('/', '-',$timeComment)));
		$dateShow = $dateComment." ".$timeComment;
	}
	

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undergraduate </title>
	<?php include'fragment/headerScript.php' ?>
  
</head>
<body>
<?php include 'fragment/navbar.php'; ?>
<div class="container">
	<h3>Comment form lecturer : <?php echo $eventTitle ?></h3><hr>
	

	<div class="panel panel-default">
	  <div class="panel-heading"><?php echo $eventTitle ?> : <?php echo $dateShow; ?></div>
	  <div class="panel-body"><?php echo $comment; ?></div>
	</div>
</div>
</body>
</html>