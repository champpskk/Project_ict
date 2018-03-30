<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

$resultUserGroup = $_SESSION['group'];

$resultUserGroupArray = explode(',',$resultUserGroup,3);



$resultUserGroup1 = $resultUserGroupArray[0];
$resultUserGroup2 = $resultUserGroupArray[1];
$resultUserGroup3 = $resultUserGroupArray[2];
$resultUserGroup4 = $resultUserGroupArray[3];


if(isset($_GET['id'])){



    // if($_SESSION['group'] == 'Student'){
    //
    //
    //   $sql_project = "SELECT PROJ_ID, PROJ_NAME_ENG FROM project WHERE STD_ID_1 = '".$_SESSION['isid']."' OR STD_ID_2 = '".$_SESSION['isid']. "' OR STD_ID_3 = '".$_SESSION['isid']."' ";
    //   $res_project = mysqli_query($conn,$sql_project);
    //
    //   $row_pro = mysqli_fetch_assoc($res_project);
    //
    //   $project_id = $row_pro['PROJ_ID'];
    //
    //
    // }
  $project_id = $_GET['id'];
  $sql_project = "SELECT PROJ_ID, PROJ_NAME_ENG FROM project WHERE PROJ_ID = $project_id ";
  $res_project = mysqli_query($conn,$sql_project);

  $row_pro = mysqli_fetch_assoc($res_project);

  $project_name = $row_pro['PROJ_NAME_ENG'];
  $show_link = 0;
}else{
  // echo $_SESSION['group'];
  // echo $_SESSION['isid'];

  $sql_project = "SELECT PROJ_ID, PROJ_NAME_ENG FROM project WHERE STD_ID_1 = '".$_SESSION['isid']."' OR STD_ID_2 = '".$_SESSION['isid']. "' OR STD_ID_3 = '".$_SESSION['isid']."' ";
  $res_project = mysqli_query($conn,$sql_project);

  $num_pro = mysqli_num_rows($res_project);

  if($num_pro == 0) {
      $project_name = "NOT PROJECT PLESE ADD PROJECT NOW";
      $show_link = 1;
  }else{
    $row_pro = mysqli_fetch_assoc($res_project);

    $project_name = $row_pro['PROJ_NAME_ENG'];
    $project_id = $row_pro['PROJ_ID'];
    $show_link = 0;

  }





  // echo $row_pro['PROJ_ID'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project</title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>

	<?php include 'fragment/navbar.php'; ?>
  <style type="text/css">
    .button{
      color: #fff !important;
      /*word-spacing: 0.25em;*/
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      border: 1px solid #ECF0F1;
      line-height: 18px;
      padding: 0.3em 0.3em 0.3em 0.3em;
      text-align: center;
      display: inline-block;
      margin: 0.1em 0.1em 0.1em 0.1em;
      text-decoration: none;
    }
    .button:visited{
      color: #fff;
    }
    .button{
      padding: 6px 12px 5px;
      font-size: 11px;
      color: #fff;
      text-shadow: none;
    }
    .button:hover{
      color: rgba(255,255,255, 0.75);
      text-decoration: none;
      -webkit-box-shadow:inset 0 10px 20px rgba(255,255,255, 0.10);
      -moz-box-shadow: inset 0 10px 20px rgba(255,255,255, 0.10);
      box-shadow: inset 0 10px 20px rgba(255,255,255, 0.10);
    }
    .button:active {
      -webkit-box-shadow: inset 0 2px 2px rgba(0,0,0, 0.3), inset 0 10px 20px rgba(0,0,0, 0.08);
      -moz-box-shadow: inset 0 2px 2px rgba(0,0,0, 0.3), inset 0 10px 20px rgba(0,0,0, 0.08);
      box-shadow: inset 0 2px 2px rgba(0,0,0, 0.3), inset 0 10px 20px rgba(0,0,0, 0.08);
    }
    .button-complete{
      background: #87ac5a;
      border: 1px solid #B3D68f;
    }
    /*.button-complete-un {
      background: #B3D68f;
    }*/
    .button-not-complete{
      background: #d74340;
      border: 1px solid #EB9390;
    }
    .msg-pending {
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      padding: 6px 12px 5px;
      font-size: 11px;
      color: #fff;
      text-shadow: none;
      display: inline-block;
      background: #D8A944;
      border: 1px solid #E2C585;
    }
    .msg-not-file{
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      padding: 6px 12px 5px;
      font-size: 11px;
      color: #fff;
      text-shadow: none;
      display: inline-block;
      background: #EB939f;
      border: 1px solid #EB9390;
    }
    .msg-resubmit {
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      padding: 6px 12px 5px;
      font-size: 11px;
      color: #fff;
      text-shadow: none;
      display: inline-block;
      background: #F53731 ;
      border: 1px solid #EC504B;

    }
    .msg-complete {
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      padding: 6px 12px 5px;
      font-size: 11px;
      color: #fff;
      text-shadow: none;
      display: inline-block;
      background: #87ac5a;
      border: 1px solid #B3D68f;
    }

  </style>
<div class="container">
     <h3><?php echo $project_name ?></h3><hr>

      <?php

        if($show_link == 1) {
          echo '<div class="form-group" >
                  <div class="col-sm-12" align="center" style="margin: 30px 0px;">
                  <a class="btn btn-primary" href="project_add.php" >ADD PROJECT</a>
                  </div>
                </div>
                ';
        } else {

          echo '<table class="table table-bordered" style="margin-top: 40px;">
                  <thead>
                    <tr>
                      <th width="2%">#</th>
                      <th width="50%">TITLE</th>';
                    if($resultUserGroup1 == 'ModuleLeader') {
                      // echo '<th width="20%">CHECK</th>';
                    }

                    if($resultUserGroup1 == 'Student') {
                      echo '<th width="10%">STATUS</th>';
                      echo '<th width="20%">Comment from lecturer</th>';
                    }
          echo        '<th>DATE AND TIME</th>
                    </tr>
                  </thead>
                  <tbody> ';


                  $sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DATE_BEGIN,EVENT_TIME_BEGIN, EVENT_DATE_DUE,EVENT_TIME_DUE FROM events";
                  $res = mysqli_query($conn,$sql);

                  if(mysqli_num_rows($res) == 0) {


                              echo "<tr>";
                              echo "<th scope='row'>1</th>";
                              echo "<td></td>";
                              echo "<td></td>";
                              echo "<td></td>";
                              if($_SESSION['group'] == 'Student') {
                                echo "<td></td>";
                              }
                              echo "</tr>";
                  }else{
                    $count = 0;
                    $numRow = mysqli_num_rows($res);

                    while($row = mysqli_fetch_assoc($res)) {
                      $count++;

                      $resultDateDue = date('d/m/Y',strtotime(str_replace('/', '-', $row['EVENT_DATE_DUE'] )));;
                      $resultTimeDue = date('H:i A',strtotime(str_replace('/', '-',$row['EVENT_TIME_DUE'])));;;

                      $sql2 = "SELECT AC_ID,AC_STATUS,FILE_NAME,AC_COMMENT,AC_COMPLETE FROM sent_activity WHERE PRO_ID = ".$project_id." AND EVENT_ID = ".$row['EVENT_ID'];
                      $res2 = mysqli_query($conn,$sql2);
                      $row2 = mysqli_fetch_assoc($res2); //res = 2 ตามของพี่เค้า

                      $statusUp = $row2['AC_STATUS'];
                      $comments = $row2['AC_COMMENT'];
                      $ac_id = $row2['AC_ID'];
                      $complete = $row2['AC_COMPLETE'];

                      if($statusUp == 1){
                        $showMgs = $row['EVENT_TITLE']." (# Sent)";
                      }else{
                        $showMgs = $row['EVENT_TITLE'];
                      }

                      if($comments != '') {
                        $showMgs .= " & (# Comment ) ";
                      }

                      if($comments != ""){
                        $comments = 'You have 1 comment';
                      }else{
                        $comments = '-';
                      }
                      
                      // if($complete == 0){
                      //   $CheckU = ' button-not-complete';
                      //   $CheckC = ' ';
                      // }else{
                      //   $CheckU = ' ';
                      //   $CheckC = ' button-complete';
                      // }

                      if($statusUp == 0){
                        $statusMsg = '<div class=" msg-not-file">No Submit</div>';
                        // $statusMsg = 'Pending';
                      }else{

                        if($complete == 0){
                          $statusMsg = '<div class=" msg-pending">Pending</div>';
                        }elseif($complete == 1){
                          $statusMsg = '<div class=" msg-complete">Complete</div>';
                        }elseif($complete == 2){
                          $statusMsg = '<div class=" msg-resubmit">Resubmit</div>';
                        }
                      }

                      echo "<tr>";
                      echo "<th scope='row'>". $count ."</th>";
                      echo "<td><a href='project_upload.php?event=". $row['EVENT_ID'] ."&project=".$project_id."'>".$showMgs."</a></td>";
                      if($resultUserGroup1 == 'Student') {
                        echo "<td>".$statusMsg."</td>";
                        echo "<td><a href='comment.php?id=".$ac_id."&event=".$row['EVENT_ID']."'>".$comments."</a></td>";
                      }
                      if($resultUserGroup1 == 'ModuleLeader') {
                        // echo "<td id='checkUp'>";
                        // echo '<button class="button '.$CheckC.'" id="btnCheckC_'.$row['EVENT_ID'].'" onclick="checkStatus('.$row['EVENT_ID'].','.$project_id.',1)">Complete</button>';
                        // echo '<button class="button '.$CheckU.'" id="btnCheckU_'.$row['EVENT_ID'].'" onclick="checkStatus('.$row['EVENT_ID'].','.$project_id.',0)">Not Complete</button>';
                        // echo "</td>";
                      }

                      echo "<td>". $resultDateDue." ".$resultTimeDue."</td>";

                      echo "</tr>";

                    }

                  }

            echo '</tbody>';
            echo '</table>';

        }

      ?>




</div> <!-- /container -->
<script type="text/javascript">
  $(function () {

    checkStatus = function(eventId,projectId,value){
      if(value === 1){
        $('#checkUp #btnCheckU_'+eventId).removeClass('button-not-complete');
        $('#checkUp #btnCheckU_'+eventId).addClass('');
        $('#checkUp #btnCheckC_'+eventId).addClass('button-complete');
      }else{
        $('#checkUp #btnCheckC_'+eventId).removeClass('button-complete');
        $('#checkUp #btnCheckC_'+eventId).addClass('');
        $('#checkUp #btnCheckU_'+eventId).addClass('button-not-complete');
      }

      $.post("data_ac.php", {ac_complete: value,event_id:eventId,project_id:projectId}, function(result){
        console.log(result);
      });
    };
    // changeComplte = function(id){
    //     $('#check-complete-'+id).click(function(e) {
    //       e.preventDefault();
    //       $('#check-complete-'+id).not(this).prop('checked', false);
    //       $(this).prop('checked', true);
    //     });
    // };
    // var checkId = $('#check-complete');
    // $('.check-complete').change(function(e) {
    //   e.preventDefault();
    //   $('.check-complete').not(this).prop('checked', false);
    //   $(this).prop('checked', true);
    // });
});
</script>
</body>
</html>
