<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

// if($_GET['id'] ){
//     echo "<script> window.location.href = 'index.php'</script>";
// } //8-10 ปิดอยู่
// $statusUp = 0;

if(isset($_GET['event']) && isset($_GET['project'])){
  $event_id = $_GET['event'];
  $project_id = $_GET['project'];

  $sql = "SELECT EVENT_TITLE, EVENT_DETAIL, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN, EVENT_DATE_DUE, EVENT_TIME_DUE,EVENT_FILE FROM events WHERE EVENT_ID=". $event_id;
  $res = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($res);
  $row = mysqli_fetch_assoc($res);

  $title =  $row['EVENT_TITLE'];
  $detail = $row['EVENT_DETAIL'];
  $file = $row['EVENT_FILE'];

  $datebegin =  $row['EVENT_DATE_BEGIN'];
  $datebegin = date('d/m/Y', strtotime(str_replace('/', '-',$datebegin)));
  $datebegin2 = date('l , d F Y', strtotime(str_replace('/', '-',$datebegin)));

  $timeBegin = $row['EVENT_TIME_BEGIN'];
  $timeBegin = date('h:i A', strtotime(str_replace('/', '-',$timeBegin)));

  $datedue =  $row['EVENT_DATE_DUE'];
  $datedue = date('d/m/Y', strtotime(str_replace('/', '-',$datedue)));
  $datedue2 = date('l , d F Y', strtotime(str_replace('/', '-',$datedue)));


  $timeDue = $row['EVENT_TIME_DUE'];
  $timeDue = date('h:i A', strtotime(str_replace('/', '-',$timeDue)));

  $sql5 = "SELECT AC_ID,AC_STATUS,FILE_NAME,DATE_SENT,TIME_SENT FROM sent_activity WHERE PRO_ID = $project_id AND EVENT_ID = $event_id";
  $res5 = mysqli_query($conn,$sql5);
  $row = mysqli_fetch_assoc($res5);   //show file sent

  $statusUp = $row['AC_STATUS'];
  $filename = $row['FILE_NAME'];
  $ac_id = $row['AC_ID'];

  $dateSent = $row['DATE_SENT'];
  $timeSent = $row['TIME_SENT'];




  if($statusUp == 1){
    $downloadFile = "<a href='uploads/".$filename."'>".$filename."</a>";
  }

}



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1; //ของเดิมเปิดอยู่
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["btn-submit"])) {
    // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); //ของเดิมปิดอยู่

    $project_id = $_POST['project_id'];
    $event_id = $_POST['event_id'];
    $statusUp = $_POST['statusUp'];
    $ac_id = $_POST['ac_id'];

    $sql2 = "SELECT EVENT_TITLE, EVENT_DETAIL, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN, EVENT_DATE_DUE, EVENT_TIME_DUE, EVENT_FILE FROM events WHERE EVENT_ID=". $event_id;
    $res2 = mysqli_query($conn,$sql2);
    $num = mysqli_num_rows($res2);
    $row = mysqli_fetch_assoc($res2);

    $title =  $row['EVENT_TITLE'];
    $detail = $row['EVENT_DETAIL'];
    $file = $row['EVENT_FILE'];

    $datebegin =  $row['EVENT_DATE_BEGIN'];
    $datebegin = date('d/m/Y', strtotime(str_replace('/', '-',$datebegin)));
    $datebegin2 = date('l , d F Y', strtotime(str_replace('/', '-',$datebegin)));

    $timeBegin = $row['EVENT_TIME_BEGIN'];
    $timeBegin = date('h:i A', strtotime(str_replace('/', '-',$timeBegin)));

    $datedue =  $row['EVENT_DATE_DUE'];
    $datedue = date('d/m/Y', strtotime(str_replace('/', '-',$datedue)));
    $datedue2 = date('l , d F Y', strtotime(str_replace('/', '-',$datedue)));


    $timeDue = $row['EVENT_TIME_DUE'];
    $timeDue = date('h:i A', strtotime(str_replace('/', '-',$timeDue)));

    $check = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $filename = basename($_FILES["fileToUpload"]["name"]);

    // echo "<a href='uploads/".basename($_FILES["fileToUpload"]["name"])."'>".basename($_FILES["fileToUpload"]["name"])."</a>";
    //
    //
    // echo $filename = $target_dir.basename( $_FILES["fileToUpload"]["name"]);
    //
    // header("Content-Length: " . filesize($filename));
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition:filename=$filename');
    //
    // readfile($filename);
    // echo $statusUp;
    // echo $project_id;
    // echo $event_id;
    if($statusUp == 0){
      $sql3 = "INSERT INTO sent_activity(PRO_ID,EVENT_ID,FILE_NAME,DATE_SENT,TIME_SENT,AC_STATUS) VALUES ('$project_id',$event_id,'$filename',CURDATE(),CURTIME(),1)";
      mysqli_query($conn,$sql3);

    }else{
      $sql3 = "UPDATE sent_activity SET

                                    FILE_NAME = '$filename',
                                    DATE_SENT = CURDATE(),
                                    TIME_SENT = CURTIME(),
                                    AC_STATUS = 1
                                    WHERE AC_ID = ".$ac_id;
      mysqli_query($conn,$sql3);

    }



    $downloadFile = "<a href='uploads/".$filename."'>".$filename."</a>";

    // $l = "project_upload.php?event=".$event_id."&project=".$project_id;

   // header('location:'.$l);
    // echo "<script> window.location.href = 'project_upload.php?event=".$event_id."&project=".$project_id."' </script>";


}

if(isset($_POST['btn-comment'])) {

    $project_id = $_POST['project_id'];
    $event_id = $_POST['event_id'];

    $vaComment = $_POST['comment'];

    $sql3 = "UPDATE sent_activity SET AC_COMMENT = '$vaComment'
                                  WHERE PRO_ID = '$project_id' AND EVENT_ID = $event_id";
    mysqli_query($conn,$sql3);

    echo "<script> window.location.href = 'project.php?id=".$project_id."' </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EVENTS | STUDENTS1 </title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>

	<?php include 'fragment/navbar.php'; ?>
  <div class="container">
      <h3><?php echo strtoupper($title); ?></h3><hr>
      <!--  -->
      <p>
        <h4 align="center" style="margin-top: 40px;"><strong>
        Submit <?php echo $title; ?> - Due date: <?php echo $datedue; echo ' '; echo $timeDue ;?> </strong></h4>
      </p>
      <div>
        <p>
          <?php

            if($detail != ""){
              echo '<div align="center" style="padding: 10px">' .$detail .'</div>';
            }

            if($file != ""){
              echo '<div align="center" style="padding: 10px"> File >>> <a href="uploads/'.$file.'">'.$file.'</a> <<< </div>';
            }

          ?>

        </p>
      </div>




      <?php

        if(isset($downloadFile)){
          echo '<div align="center" style="padding: 10px"> Download >>> '.$downloadFile.' <<< </div>';
        }else {
          echo '<div align="center"><h1>NOT FILE</h1> </div>';
        }


        if($dateSent != "" && $timeSent != "") {
          $dateSent = date('d/m/Y', strtotime(str_replace('/', '-',$dateSent)));
          $dateSent = date('l , d F Y', strtotime(str_replace('/', '-',$dateSent)));


          $timeSent = date('h:i A', strtotime(str_replace('/', '-',$timeSent)));
          echo '<div align="center" style="padding: 10px"> '.$dateSent.'  '.$timeSent.' </div>';
        }  //showdate


        $resultUserGroup = $_SESSION['group'];
        if($resultUserGroup != 'Student' || $resultUserGroup != 'Lecturer'
          || $resultUserGroup != 'ModuleLeader' || $resultUserGroup != 'Admin')
        {
          $resultUserGroupArray = explode(',',$resultUserGroup,3);
          $vaGroup = trim($resultUserGroupArray[0]);
        }
        else
        {
          $vaGroup = $_SESSION['group'];
        }



        if($vaGroup == 'Student') {

          echo '
          <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="POST" enctype="multipart/form-data">
            <div class="form-group">

              <label class="control-label col-md-3" for="fileToUpload" ></label>
              <div class="col-md-6" align="center">
                <input type="file" id="fileToUpload" name="fileToUpload" style="margin-top:100px;" >

                <input type="hidden" name="project_id" id="project_id" value="'.$project_id.'">

                <input type="hidden" name="event_id" id="event_id" value="'.$event_id.'">';

            if($statusUp == 1) {
              echo '<input type="hidden" name="statusUp" id="statusUp" value="1">';
              echo '<input type="hidden" name="ac_id" id="ac_id" value="'.$ac_id.'">';
            }
            echo '<button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="btn-submit">Upload this file</button>
              </div>
              </div>';

            if(isset($ac_id)) {

            $sql4 = "SELECT AC_COMMENT FROM sent_activity WHERE AC_ID = ".$ac_id;
            $resComment = mysqli_query($conn,$sql4);
            $row = mysqli_fetch_assoc($resComment);

            $vaComment = $row['AC_COMMENT'];
          }

            echo '</form>';

            //form


        }

        if($vaGroup == 'Lecturer' && $statusUp == 1) {
          $sql4 = "SELECT AC_COMMENT FROM sent_activity
                                    WHERE PRO_ID = '$project_id' AND EVENT_ID = $event_id";
          $resComment = mysqli_query($conn,$sql4);
          $row = mysqli_fetch_assoc($resComment);

          $vaComment = $row['AC_COMMENT'];

          echo '
          <form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-2" for="comment" >COMMENT: </label>
                <div class="col-md-6">
                     <textarea  class="form-control" rows="4" name="comment" id="comment">'. $vaComment .'</textarea>
                </div>
            </div>
            <div class="col-md-6">
              <input type="hidden" name="project_id" id="project_id" value="'.$project_id.'">

              <input type="hidden" name="event_id" id="event_id" value="'.$event_id.'">

              <button type="submit" class="btn btn-primary" style="margin-top: 5%;" name="btn-comment">SEND COMMENT</button>
            </div>
          </form>';
        }


      ?>

      <p style="margin-top:17%;"><strong>Available from:</strong>  <?php echo $datebegin2; echo ' '; echo $timeBegin ; ?></p>
      <p ><strong>Due date:</strong>   <?php echo $datedue2; echo ' '; echo $timeDue ; ?></p>
    </div>

</body>
</html>

<?php

?>
