<?php
require_once 'config/dbconfig.php';

$count = 0;

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
     <h3>MANAGEMENT PROJECT</h3><hr>

          <!-- <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" align="right" style="margin-bottom: 10px;">
              <a class="btn btn-primary" href="project_add.php">ADD PROJECT</a>
            </div>
          </div>
 -->

            <table class="table table-bordered" style="margin-top: 40px;">
              <thead>
                <tr>
                  <th width="2%">#</th>
                  <th>PROJECT TITLE(ENG)</th>
                  <th>DEVELOPER NAME</th>
                  <th>ADVISER</th>
                  <th>CHANGES</th>
                  <!-- <th>LAST UPDATE</th> -->
                </tr>
              </thead>

            <?php

          $sql = "SELECT PROJ_ID,
                        PROJ_NAME_ENG,
                        PROJ_NAME_TH,
                        PROJ_TYPE_ID,
                        STD_ID_1,
                        STD_ID_2,
                        STD_ID_3,
                        LEC_ID_1,
                        LEC_ID_2 FROM project ORDER BY PROJ_ID DESC";

          $res = mysqli_query($conn,$sql);

                  if(mysqli_num_rows($res) == 0) {

                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>1</th>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "<i class='fa fa-times' aria-hidden='true'></i>";
                        echo "<i class='fa fa-pencil-square-o' aria-hidden='true'></i>";
                        echo "</td>";
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

                      $lec_name1 = '';
                      $lec_name2 = '';

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

                      $res4 = mysqli_query($conn,"SELECT LEC_NAME FROM  lecturers WHERE  LEC_ID = '". $row['LEC_ID_1']."' ");
                      $res5 = mysqli_query($conn,"SELECT LEC_NAME FROM  lecturers WHERE  LEC_ID = '". $row['LEC_ID_2']."' ");

                      if(mysqli_num_rows($res4) == 1){
                        $r4 = mysqli_fetch_assoc($res4);
                        $lec_name = $r4['LEC_NAME'];
                      }

                      if(mysqli_num_rows($res5) == 1){
                        $r5 = mysqli_fetch_assoc($res5);
                        $lec_name2 = $r5['LEC_NAME'];
                      }

                      echo "<tbody>";
                      echo "<tr>";
                      echo "<th scope='row'>". $count ."</th>";
                      echo "<td><a href='project.php?id=" . $row['PROJ_ID']. "'>". $row['PROJ_NAME_ENG']."</a></td>";
                      echo "<td><span style='display:block;'>". $stu_name1 ."</span><span style='display:block;'>". $stu_name2 ."</span><span style='display:block;'>". $stu_name3 ."</span></td>";
                      echo "<td><span style='display:block;'>". $lec_name ."</span><span style='display:block;'>". $lec_name2 ."</span> </td>";
                      echo "<td>";
                      echo "<span style='padding:5px;'><button class='btn btn-danger' id='proj_del".$row['PROJ_ID']."' onclick='delProject(".$row['PROJ_ID'].")' >DEL</button></span>";
                      echo "<span style='padding:5px;'><a class='btn btn-success' href='project_edit.php?id=".$row['PROJ_ID']."'>EDIT</span>";
                      echo "</td>";
                      // echo "<td></td>";
                      echo "</tr>";
                      echo "</tbody>";
                    }

                  }

                ?>
            </table>



</div> <!-- /container -->

<script type="text/javascript">

$(function(){


  delProject = function(id) {
    var $ele = $('#proj_del'+id).parent().parent().parent().parent();
    // alert($ele);
    // console.log($ele);
    //$ele.fadeOut().remove();
    $.ajax({
        type:'POST',
        url:'delete.php',
        data:{'project_id':id},
        success: function(data){
             if(data=="YES"){
                $ele.fadeOut().remove();
             }else{
                    alert("can't delete the row")
             }
         }

    });
  }
});
</script>

</body>
</html>
