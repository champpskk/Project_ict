<?php
require_once 'config/dbconfig.php';
$resultUserGroup = $_SESSION['group'];
$resultUserGroupArray = explode(',',$resultUserGroup,3);
$resultUserGroup1 = $resultUserGroupArray[0];

if($resultUserGroup1 == 'ModuleLeader' && isset($_GET['id'])){

  $eventId = trim($_GET['id']);
  $sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DETAIL, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN, EVENT_DATE_DUE, EVENT_TIME_DUE,EVENT_FILE FROM events WHERE EVENT_ID = ".$eventId;
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);

  $eventTitle = $row['EVENT_TITLE'];


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
     <h3><?php echo $eventTitle; ?></h3><hr>

     <table class="table table-bordered" style="margin-top: 40px;">
      <thead>
      <tr>
        <th width="2%">#</th>
        <th width="30%">TITLE</th>
        <th width="20%">DEVELOP NAME</th>
        <th width="25%">DATA AND TIME</th>
        <th width="20%">STATUS</th>
      </tr>
      </thead>
      <tbody>

      <?php

        $sql = "SELECT AC_ID,AC_STATUS,FILE_NAME,AC_COMMENT,AC_COMPLETE,PRO_ID,DATE_SENT,TIME_SENT FROM sent_activity WHERE EVENT_ID = ".$eventId;
        $res = mysqli_query($conn,$sql);
        // $row = mysqli_fetch_assoc($res);



        if(mysqli_num_rows($res) == 0) {
          echo "<tr>";
          echo "<th scope='row'>1</th>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "</tr>";
        }else{
          $count = 0;
          while($row = mysqli_fetch_assoc($res)) {
            $count++;
            $projectId = $row['PRO_ID'];
            $dateSent = $row['DATE_SENT'];
            $timeSent = $row['TIME_SENT'];
            $complete = $row['AC_COMPLETE'];
            $ac_id = $row['AC_ID'];

            $stu_name1 = '';
            $stu_name2 = '';
            $stu_name3 = '';

            $dateSent = date('d/m/Y', strtotime(str_replace('/', '-',$dateSent)));
            $dateSent = date('l , d F Y', strtotime(str_replace('/', '-',$dateSent)));
            $timeSent = date('h:i A', strtotime(str_replace('/', '-',$timeSent)));

            if($row['DATE_SENT'] == "" || $row['TIME_SENT'] == "") {
              $dateSent = '-';
              $timeSent = '';
            }







            $sql_project = "SELECT STD_ID_1,STD_ID_2,STD_ID_3 FROM project WHERE PROJ_ID = ".$projectId;
            $res_project = mysqli_query($conn,$sql_project);
            $row_project = mysqli_fetch_assoc($res_project);

            $res1 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row_project['STD_ID_1']."' ");
            $res2 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row_project['STD_ID_2']."' ");
            $res3 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row_project['STD_ID_3']."' ");


            if(mysqli_num_rows($res1) == 1){
              $r1 = mysqli_fetch_assoc($res1);
              $stu_name1 = $r1['STU_NAME'];
            }

            if(mysqli_num_rows($res2) == 1){
              $r2 = mysqli_fetch_assoc($res2);
              $stu_name2 = $r2['STU_NAME'];
            }

            if(mysqli_num_rows($res3) == 1){
              $r3 = mysqli_fetch_assoc($res3);
              $stu_name3 = $r3['STU_NAME'];
            }




            echo "<tr>";
            echo "<th scope='row'>". $count ."</th>";
            echo "<td>".$eventTitle."</td>";
            echo "<td><span style='display:block;'>". $stu_name1 ."</span><span style='display:block;'>". $stu_name2 ."</span><span style='display:block;'>". $stu_name3 ."</span></td>";
            echo "<td>".$dateSent."  ".$timeSent."</td>";
            echo "<td>";
            echo "<select id='status_".$projectId."' onchange='changeStatus(".$projectId.",".$eventId.")'' >";
            echo  "<option value='0' ";
                    if($complete == 0) echo 'SELECTED disabled hidden';
            echo ">Checking</option>";
            echo "<option value='1' ";
                    if($complete == 1) echo 'SELECTED';
            echo ">Except</option>";
            echo "<option value='2' ";
                    if($complete == 2) echo 'SELECTED';
            echo ">No Except</option>";
            echo "</select>";
            echo "</td>";
            echo "</tr>";
          }

        }
        echo '</tbody>';
        echo '</table>';

        // $stu_id = $_SESSION['isid'];
        // $sql = "SELECT PROJ_ID FROM project WHERE STD_ID_1 = '$stu_id' OR STD_ID_2 = '$stu_id' OR STD_ID_3 = '$stu_id' ";
        //
        //
        //
        // $project_id = $row['PROJ_ID'];
      ?>
      </div>
  <script type="text/javascript">
    $(function () {

      changeStatus = function(projectId,eventId){

        var value = $('#status_'+projectId).val();
        console.log(value+" "+projectId+" "+eventId);
        $.post("data_ac.php", {ac_complete: value,event_id:eventId,project_id:projectId}, function(result){
          console.log(result);
        });
      }

  });
  </script>
  </body>

 </html>
