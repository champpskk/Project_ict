<?php
include('config/dbconfig.php');

if(isset($_POST['event_id'])){
	$event_id = $_POST['event_id'];
	//echo $music_number;
	$sql = "DELETE FROM events WHERE EVENT_ID = $event_id";
	$res = mysqli_query($conn,$sql);
	if(isset($res)) {
	   echo "YES";
	} else {
	   echo "NO";
	}
	exit();
}

if(isset($_POST['news_id'])){
	$news_id = $_POST['news_id'];
	//echo $music_number;
	$sql = "DELETE FROM news WHERE NEWS_ID = $news_id";
	$res = mysqli_query($conn,$sql);
	if(isset($res)) {
	   echo "YES";
	} else {
	   echo "NO";
	}
	exit();
}


if(isset($_POST['project_id'])){
	$project_id = $_POST['project_id'];
	//echo $music_number;
	$sql = "DELETE FROM project WHERE PROJ_ID = $project_id";
	$res = mysqli_query($conn,$sql);
	if(isset($res)) {
	   echo "YES";
	} else {
	   echo "NO";
	}
	exit();
}

if(isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];
	//echo $music_number;
	$sql = "DELETE FROM users WHERE USER_ID = $user_id";
	$res = mysqli_query($conn,$sql);
	if(isset($res)) {
	   echo "YES";
	} else {
	   echo "NO";
	}
	exit();
}
?>

