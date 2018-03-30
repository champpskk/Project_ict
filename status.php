<?php 
require_once 'config/dbconfig.php';
$resultUserGroup = $_SESSION['group']; 
$resultUserGroupArray = explode(',',$resultUserGroup,3);
$resultUserGroup1 = $resultUserGroupArray[0];    


if($resultUserGroup1 == 'ModuleLeader'){
  $stu_id = $_SESSION['isid'];
  $sql = "SELECT PROJ_ID FROM project WHERE STD_ID_1 = '$stu_id' OR STD_ID_2 = '$stu_id' OR STD_ID_3 = '$stu_id' ";

  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);

  $project_id = $row['PROJ_ID'];
}elseif($resultUserGroup1 == 'Student'){
  $stu_id = $_SESSION['isid'];
  $sql = "SELECT PROJ_ID FROM project WHERE STD_ID_1 = '$stu_id' OR STD_ID_2 = '$stu_id' OR STD_ID_3 = '$stu_id' ";

  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);

  $project_id = $row['PROJ_ID'];

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

  <style type="text/css">
    .msg-send {
      background: #2e7d32;
      border: 1px solid #008000;
      color: #FFFACD;
    }
    .msg-notsend {
      background: #d32f2f;
      border: 1px solid #008000;
      color: #FFFACD;
    }
  </style>
</head>
<body>
<?php include 'fragment/navbar.php'; ?>
<div class="container">
     <h3>STATUS</h3><hr>
          
			<table class="table table-bordered" style="margin-top: 40px;">
              <thead>
                <tr>
                <?php  
                  if($resultUserGroup1 == 'Student'){
                    echo '<th>#</th>';
                    echo '<th>Titile</th>';                                 
                    echo '<th>Date And Time</th>';
                    echo '<th>Status</th>';     
                  }elseif($resultUserGroup1 == 'ModuleLeader'){
                    echo '<th width="2%">#</th>';
                    echo '<th width="40%">Titile</th>';                                 
                    echo '<th width="40%">Due Date</th>';                    
                  }

                ?>
                               
                  
                </tr>
              </thead>
             
            <?php
          
           	$sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DETAIL, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN, EVENT_DATE_DUE, EVENT_TIME_DUE,EVENT_FILE FROM events ";
    			  $res = mysqli_query($conn,$sql);
    			  $num = mysqli_num_rows($res);
    			  $row = mysqli_fetch_assoc($res);
			  
            
          

            $res = mysqli_query($conn,$sql); 

            if($resultUserGroup1 == 'Student'){
                    
               
                if(mysqli_num_rows($res) == 0) {
              
                  echo "<tbody>";
                  echo "<tr>";
                  echo "<th scope='row'>1</th>";                        
                  echo "<td></td>";                    
                  echo "<td></td>";
                  // echo "<td></td>";
                  echo "</tr>";
                  echo "</tbody>";             

                }else{
                  $count = 0;
                  while($row = mysqli_fetch_assoc($res)) {
                    $count++; 
                    $event_id = $row['EVENT_ID'];
                    $sql2 = "SELECT AC_ID,AC_STATUS,FILE_NAME,DATE_SENT,TIME_SENT,AC_COMMENT,DATE_COMMENT,TIME_COMMENT FROM sent_activity WHERE PRO_ID = $project_id AND EVENT_ID = $event_id";
                    $res2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($res2);
                    $dateSent = $row2['DATE_SENT'];
                    $timeSent = $row2['TIME_SENT'];
                    $statusUp = $row2['AC_STATUS'];
                    $comment = $row2['AC_COMMENT'];
                    // $dateComment = $row2['DATE_COMMENT'];
                    // $timeComment = $row2['TIME_COMMENT'];

                    $dateSent = date('d/m/Y', strtotime(str_replace('/', '-',$dateSent)));
                    $dateSent = date('l , d F Y', strtotime(str_replace('/', '-',$dateSent)));                 
                    $timeSent = date('h:i A', strtotime(str_replace('/', '-',$timeSent)));

                    if($row2['DATE_SENT'] == "" || $row2['TIME_SENT'] == "") {
                      $dateSent = '-';
                      $timeSent = '';
                    }
        
                    if($statusUp == 1) {
                      $status = '<div class="msg-send">Sending</div>';
                    }else{
                      $status = '<div class="msg-notsend">Not Sending</div>';
                    }
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>". $count ."</th>";
                        echo "<td>".$row['EVENT_TITLE']."</td>";                      
                        echo "<td>".$dateSent."  ".$timeSent."</td>";
                        echo "<td>".$status."</td>";                  
                        echo "</tr>";
                        echo "</tbody>";
                    }
          
            }       
         
           }elseif($resultUserGroup1 == 'ModuleLeader'){

              $sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DETAIL, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN, EVENT_DATE_DUE, EVENT_TIME_DUE,EVENT_FILE FROM events ";
              $res = mysqli_query($conn,$sql);
              
              // $row = mysqli_fetch_assoc($res);
              if(mysqli_num_rows($res) == 0) {
              
                  echo "<tbody>";
                  echo "<tr>";
                  echo "<th scope='row'>1</th>";                        
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
                  echo "</tbody>";             

                }else{
                  $count = 0;

                  while($row = mysqli_fetch_assoc($res)) {
                    $count++;  

                    $dateDue = $row['EVENT_DATE_DUE'];
                    $timeDue = $row['EVENT_TIME_DUE'];

                    $dateDue = date('d/m/Y', strtotime(str_replace('/', '-',$dateDue)));
                    $dateDue = date('l , d F Y', strtotime(str_replace('/', '-',$dateDue)));                 
                    $timeDue = date('h:i A', strtotime(str_replace('/', '-',$timeDue)));   

                     // echo $num = mysqli_num_rows($res);
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>". $count ."</th>";
                        echo "<td><a href='status_check.php?id=".$row['EVENT_ID']."'>".$row['EVENT_TITLE']."</a></td>";                    
                         echo "<td>".$dateDue."  ".$timeDue."</td>";           
                        echo "</tr>";
                        echo "</tbody>";
                    }
                  }
           }
            ?>
            </table>
          
        

</div> <!-- /container -->
</body>
</html>