<?php 

require_once 'config/dbconfig.php';



$ac_value = trim($_POST['ac_complete']);
$event_id = trim($_POST['event_id']);
$project_id = trim($_POST['project_id']);

$sql = "UPDATE sent_activity SET 	AC_COMPLETE = ".$ac_value."  
							WHERE	EVENT_ID = ".$event_id." 
							AND		PRO_ID = ".$project_id;

$res = mysqli_query($conn,$sql);

$data = 'SECCESS';
echo json_encode($data);
exit();


?>