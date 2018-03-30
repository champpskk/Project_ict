<?php

require_once 'config/dbconfig.php';


$key = trim($_POST['data']);
// $sql = "SELECT LEC_ID,LEC_NAME,LEC_SUR FROM lecturer WHERE LEC_NAME LIKE '%$key%' OR LEC_SUR LIKE '%key%' ";

$sql = "SELECT LEC_ID,LEC_NAME FROM lecturers WHERE LEC_NAME LIKE '%$key%' ";

$res = mysqli_query($conn,$sql);

$data = [];
$temp = [];

if(isset($res)) {
	while ($row = mysqli_fetch_assoc($res)) {

		$temp['LEC_ID'] = $row ['LEC_ID'];
		$temp['LEC_NAME'] =  $row ['LEC_NAME'];
		array_push($data,$temp);
	}
}
	echo json_encode($data);
	exit();


?>
