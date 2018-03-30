<?php
require_once 'config/dbconfig.php';

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
     <h3> SCORE</h3><hr>

     <table class="table table-bordered" style="margin-top: 40px;">
      <thead>
      <tr>
        <th width="2%">#</th>
        <th width="35%">Group</th>
        <th width="30%">DEVELOP NAME</th>
        <th width="30%">Score</th>

      </tr>
      </thead>
      <tbody>

      <?php

        $sql = "SELECT PROJ_ID,
                        PROJ_NAME_ENG,
                        PROJ_NAME_TH,
                        PROJ_TYPE_ID,
                        STD_ID_1,
                        STD_ID_2,
                        STD_ID_3,
                        LEC_ID_1,
                        LEC_ID_2 FROM project WHERE LEC_ID_1  = '".$_SESSION['isid']."' OR LEC_ID_2 = '".$_SESSION['isid']."' ORDER BY PROJ_ID DESC";

          $res = mysqli_query($conn,$sql);

                  if(mysqli_num_rows($res) == 0) {

                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>1</th>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";

                        echo "</tr>";
                        echo "</tbody>";


                  }else{
                    $count = 0;

                    while($row = mysqli_fetch_assoc($res)) {
                      $count++;

                      $stu_name1 = '';
                      $stu_name2 = '';
                      $stu_name3 = '';

                      //$sql = "SELECT STU_TITLE_NAME,STU_NAME,STU_SUR FROM student WHERE STU_ID = '$STD_ID_1' ";

                      $res1 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row['STD_ID_1']."' ");
                      $res2 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row['STD_ID_2']."' ");
                      $res3 = mysqli_query($conn,"SELECT STU_NAME FROM students WHERE STU_ID = '". $row['STD_ID_3']."' ");


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
                      echo "<td><a href='project.php?id=" . $row['PROJ_ID']. "'>". $row['PROJ_NAME_ENG']."</a></td>";
                      echo "<td><span style='display:block;'>". $stu_name1 ."</span><span style='display:block;'>". $stu_name2 ."</span><span style='display:block;'>". $stu_name3 ."</span></td>";

											echo "<td>";

                       echo "<input type='text'>";
											 echo "<span style='padding:5px;'><button class='btn btn-danger' id='event_del".$row['EVENT_ID']."' onclick='editscore(".$row['EVENT_ID'].")' >EDIT</button></span>";
											 echo "<span style='padding:5px;'><a class='btn btn-success' href='event_edit.php?id=".$row['EVENT_ID']."'>SAVE</span>";
                       echo "</td>";
                      echo "</tr>";

                    }
                  }
        echo '</tbody>';
        echo '</table>';

        ?>
      </div>
  </script>
  </body>

 </html>
