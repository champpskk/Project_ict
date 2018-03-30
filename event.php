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
      <h3>ADD ACTIVITIES</h3><hr>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10" align="right" style="margin-bottom: 10px;">
          <a class="btn btn-primary" href="event_add.php">ADD ACTIVITIES</a>
        </div>
      </div>

        <table class="table table-bordered" style="margin-top: 40px;">
          <thead>
            <tr>
              <th>#</th>
              <th width="55%">TITLE</th>
              <th width="15%">START DATE</th>
              <th width="15%">DUE DATE</th>
              <th width="15%">ACTION</th>
              <!-- <th>LAST UPDATE</th> -->
            </tr>
          </thead>

          <?php
          $sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN , EVENT_DATE_DUE , EVENT_TIME_DUE FROM events";
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
                        // echo "<td></td>";
                        echo "</tr>";
                        echo "</tbody>";


                  }else{
                    $count = 0;

                    while($row = mysqli_fetch_assoc($res)) {
                      $count++;

                      $resultDateBegin = date('d/m/Y',strtotime(str_replace('/', '-', $row['EVENT_DATE_BEGIN'] )));
                      $resultTimeBegin = date('H:i A',strtotime(str_replace('/', '-',$row['EVENT_TIME_BEGIN'])));;
                      $resultDateDue = date('d/m/Y',strtotime(str_replace('/', '-', $row['EVENT_DATE_DUE'] )));;
                      $resultTimeDue = date('H:i A',strtotime(str_replace('/', '-',$row['EVENT_TIME_DUE'])));;;

                      echo "<tbody>";
                      echo "<tr>";
                      echo "<th scope='row'>". $count ."</th>";
                      echo "<td>". $row['EVENT_TITLE']."</td>";
                      echo "<td>". $resultDateBegin ." ". $resultTimeBegin ."</td>";
                      echo "<td>". $resultDateDue." ". $resultTimeDue ."</td>";
                      echo "<td>";
                      // echo "<span class='icon_del' event_id='".$row['EVENT_ID']."' style='padding:10px;'><i class='fa fa-times' aria-hidden='true' ></i></span>";
                      // echo "<a href='event_edit.php?id=".$row['EVENT_ID']."'<span style='padding:10px;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span>";
                       echo "<span style='padding:5px;'><button class='btn btn-danger' id='event_del".$row['EVENT_ID']."' onclick='delEvent(".$row['EVENT_ID'].")' >DEL</button></span>";
                      echo "<span style='padding:5px;'><a class='btn btn-success' href='event_edit.php?id=".$row['EVENT_ID']."'>EDIT</span>";
                      echo "</td>";
                      // echo "<td></td>";
                      echo "</tr>";
                      echo "</tbody>";
                    }

                  }

                ?>

        </table>
  </div> <!-- /container -->

</body>
</html>

<script type="text/javascript">
$(function(){
  // $(document).on('click','.icon_del',function(){
  //   var event_id= $(this).attr('event_id');
  //   var $ele = $(this).parent().parent();

  //   $.ajax({
  //       type:'POST',
  //       url:'delete.php',
  //       data:{'event_id':event_id},
  //       success: function(data){
  //            if(data=="YES"){
  //               $ele.fadeOut().remove();
  //            }else{
  //                   alert("can't delete the row")
  //            }
  //        }

  //   });
  // });

  delEvent = function(id) {
    var $ele = $('#event_del'+id).parent().parent().parent().parent();
    // alert($ele);
    // console.log($ele);
    //$ele.fadeOut().remove();
    $.ajax({
        type:'POST',
        url:'delete.php',
        data:{'event_id':id},
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
