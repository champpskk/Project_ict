<?php 
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id']) && isset($_POST['btn-submit']) ){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id'])){

    $id = trim($_GET['id']);

    
    
}
// $test1 = "lecturer,ModuleLeader,Admin";
// $test = explode(',',$test1,3);
// echo $test[0]."<br>";
// echo $test[1]."<br>";
// echo $test[2]."<br>";


$error = false;
if(isset($_POST['btn-submit'])) {   
    
    $id = trim($_POST['id']);

    

    $userGroup1 = trim($_POST['userGroup1']);
    $userGroup1 = strip_tags($userGroup1);
    $userGroup1 = htmlspecialchars($userGroup1);

    $userGroup2 = trim($_POST['userGroup2']);
    $userGroup2 = strip_tags($userGroup2);
    $userGroup2 = htmlspecialchars($userGroup2);

    $userGroup3 = trim($_POST['userGroup3']);
    $userGroup3 = strip_tags($userGroup3);
    $userGroup3 = htmlspecialchars($userGroup3);

    $userGroup4 = trim($_POST['userGroup4']);
    $userGroup4 = strip_tags($userGroup4);
    $userGroup4 = htmlspecialchars($userGroup4);

    $userG = [$userGroup1,$userGroup2,$userGroup3,$userGroup4];
    // $users = [];
    //explode(" ",$users);
    // if($i=1;$i<=4;$i++){
    //     //$user = $userGroup.$i;
    //     // array_push($users,$userG);
    //     echo $i;
    // }

    $userGroup = "";
    $j=0; 

    for ($i=0;$i<4 ; $i++) { 

         
        // 

        if($userG[$i] != "") {
            // $userGroup = $userG[$i];
            if($j > 0){
                $userGroup .= ",";
            }   
            $userGroup .= $userG[$i];
                     
         $j++; 
         // echo $j;  
        }
        
        
        // echo $userG[$i];

    }
    
    //echo  $userGroup;
   
    if(!$error) {

    	

        $sql = "UPDATE users SET
                        USER_GROUP = '$userGroup'                                
                WHERE USER_ID = $id;    
                        
            
         ";

        mysqli_query($conn,$sql);

        $msgSuccess = "Update Complete";

        

        $btnBack = "member.php";

        
       
        
    }



}


if (isset($_POST['btn-cancle'])) {
    
    echo "<script> window.location.href = 'member.php' </script>";
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
        <h3>UPDATE MEMBER</h3><hr>

        <?php  

            if(isset($msgSuccess)) {
                echo '<div class="alert alert-success" role="alert">';
                echo $msgSuccess ;
                echo ' Back To Before ';
                echo '<a href="'. $btnBack .'" class="alert-link" style="padding: 0 10px;"> Click </a>';
                echo '</div>';
            }



        ?>

        <form class="form-horizontal row" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">          
           

             
            <?php if(isset($userGroupError) && $userGroupError == "" )  echo '<span class="" >'. $userGroupError ."</span>"  ?>  
            <?php 
              $sql = "SELECT USER_GROUP FROM users WHERE USER_ID = $id ";

              $res = mysqli_query($conn,$sql);
              
              $row = mysqli_fetch_assoc($res);

              $resultUserGroup = $row['USER_GROUP']; 

              $resultUserGroupArray = explode(',',$resultUserGroup,4);

              
              $resultUserGroup1 = $resultUserGroupArray[0];    
              $resultUserGroup2 = $resultUserGroupArray[1];  
              $resultUserGroup3 = $resultUserGroupArray[2];  
              $resultUserGroup4 = $resultUserGroupArray[3];  
            ?>  

            <div class="form-group">
              <label for="userGroup" class="control-label col-md-3"> USER GROUP :</label>
              <div class="checkbox">
                <label><input type="checkbox" name="userGroup1" value="Student"  
                    <?php 
                    if($resultUserGroup1 == 'Student' || $resultUserGroup2 == 'Student' 
                        || $resultUserGroup3 == 'Student' || $resultUserGroup4 == 'Student'){ 
                        echo 'value="Student" checked'; 
                    }
                        else { echo 'value="" ';
                    }

                    ?>
                >Student</label>
                <label><input type="checkbox" name="userGroup2" value="Lecturer" 
                    <?php if($resultUserGroup1 == 'Lecturer' || $resultUserGroup2 == 'Lecturer' 
                        || $resultUserGroup3 == 'Lecturer' || $resultUserGroup4 == 'Lecturer'){
                        echo 'value="Lecturer" checked';  
                    }   else {
                        echo'value="" ';
                    }
                    ?>
                >Lecturer</label>
                <label><input type="checkbox" name="userGroup3" value="ModuleLeader" 
                    <?php if($resultUserGroup1 ==  'ModuleLeader' || $resultUserGroup2 ==  'ModuleLeader' 
                        || $resultUserGroup3 ==  'ModuleLeader' || $resultUserGroup4 == 'ModuleLeader') {
                        echo 'value="ModuleLeader" checked';
                        } else {
                            echo 'value="" ';
                        }
                    ?>
                >ModuleLeader</label>
                <label><input type="checkbox" name="userGroup4" value="Admin" 
                <?php if($resultUserGroup1 ==  'Admin' || $resultUserGroup2 ==  'Admin' 
                    || $resultUserGroup3 ==  'Admin' || $resultUserGroup4 == 'Admin') {
                        echo 'value="Admin" checked';
                    } else {
                        echo 'value="" ';
                    }
                ?>
                >Admin</label>                 
              </div>                    
              
            </div>
            
            <input type="hidden" class="form-control" id="id" name="id"  value="<?php echo $id?>">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit" >UPDATE</button>
                    <button type="submit" class="btn btn-default" name="btn-cancle" >CANCLE</button>
                </div>
            </div> 

        <form>    
 
    </div> <!-- /container -->

<script type="text/javascript">

$(function () {

// var key = 'sel_name';
// var options = {
//     data: ["blue", "green", "pink", "red", "yellow"]
// };


//console.log('AA');
// $.ajax({
//         type:'POST',
//         url:'data.php',
//         data:{'key': 1},
//         dataType:'json',
//         success: function(data){
//             // console.log('AA');
//             // alert(data);
//              if(data){
//                 console.log(data);
//                 // alert(data);         

                
//              }else{
//                     alert("can't")
//              }
//          }

//     });

});
        
</script>
	
</body>
</html>