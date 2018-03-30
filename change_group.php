<?php
	require_once 'config/dbconfig.php';

	if(isset($_GET['id']) && isset($_GET['group'])){

    $id = trim($_GET['id']);
    $group = trim($_GET['group']);

    $sql = "SELECT USER_GROUP FROM users WHERE USER_ID = $id ";

    $res = mysqli_query($conn,$sql);
    echo mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);

    $resultUserGroup = $row['USER_GROUP'];

    $resultUserGroupArray = explode(',',$resultUserGroup,3);

    // echo $resultUserGroup;

    $resultUserGroup1 = trim($resultUserGroupArray[0]);
    $resultUserGroup2 = trim($resultUserGroupArray[1]);
    $resultUserGroup3 = trim($resultUserGroupArray[2]);
    $resultUserGroup4 = trim($resultUserGroupArray[3]);



    // if($group == $resultUserGroup2)
    // {
    // 	$userGroup = $resultUserGroup2.",".$resultUserGroup1;
    // }
		//
    // if($group == $resultUserGroup3)
    // {
    // 	$userGroup = $resultUserGroup3.",".$resultUserGroup2.",".$resultUserGroup1;
    // }
    // if($group == $resultUserGroup4)
    // {
    // 	$userGroup = $resultUserGroup4.",".$resultUserGroup3.",".$resultUserGroup2.",".$resultUserGroup1;
    // }

    if(count($resultUserGroupArray) == 2 )
    {
    	$userGroup = $resultUserGroup2.",".$resultUserGroup1;
    }
    if(count($resultUserGroupArray) == 3 )
    {
	    if($group == $resultUserGroup2)
	    {
	    	$userGroup = $resultUserGroup2.",".$resultUserGroup1.",".$resultUserGroup3;
	    }

	    if($group == $resultUserGroup3)
	    {
	    	$userGroup = $resultUserGroup3.",".$resultUserGroup2.",".$resultUserGroup1;
	    }


    }
    if(count($resultUserGroupArray) == 4 )
    {
    	if($group == $resultUserGroup2)
	    {
	    	$userGroup = $resultUserGroup2.",".$resultUserGroup1.",".$resultUserGroup3.",".$resultUserGroup4;
	    }

	    if($group == $resultUserGroup3)
	    {
	    	$userGroup = $resultUserGroup3.",".$resultUserGroup2.",".$resultUserGroup1.",".$resultUserGroup4;
	    }
	    if($group == $resultUserGroup4)
	    {
	    	$userGroup = $resultUserGroup4.",".$resultUserGroup3.",".$resultUserGroup2.",".$resultUserGroup1;
	    }
    }

    // echo $userGroup;

    $sql = "UPDATE users SET
                USER_GROUP = '$userGroup'
                WHERE USER_ID = $id;
        ";

    mysqli_query($conn,$sql);

    $_SESSION['group'] = $userGroup;

    echo "<script> setTimeout(window.location.href = 'home.php', 3000);  </script>";

}
?>
