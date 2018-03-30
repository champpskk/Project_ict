<?php 

require_once 'config/dbconfig.php';



$key = trim($_POST['data']);
$sql = "SELECT STU_ID,STU_NAME FROM students WHERE STU_NAME LIKE '%$key%' ";

$res = mysqli_query($conn,$sql);

$data = [];
$temp = [];	

if(isset($res)) {	
	while ($row = mysqli_fetch_assoc($res)) {	
		
		$temp['STU_ID'] = $row ['STU_ID'];
		$temp['STU_NAME'] =  $row ['STU_NAME'];		
		array_push($data,$temp);
	}

}
// else {
// 	$data['STU_ID'] = '';
// 	$data['STU_NAME'] = '';
// }	
	echo json_encode($data);
	exit();


?>