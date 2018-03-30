<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}



// $count = 0;

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
    li {list-style:none;}
  </style>



</head>
<body>

	<?php include 'fragment/navbar.php'; ?>

    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div align="center" style="margin-top: 40px;" >
            <h4>Undergraduate Project Data Management System case study ICT Programme.  </h4>
            <p>ระบบการจัดการข้อมูลโครงงานนิพนธ์นักศึกษาปริญญาตรีกรณีศึกษาสาขาเทคโนโลยีสารสนเทศและการสื่อสาร</p><hr>
                <h4 align="left">TOPIC OUTLINE</h4>
                <div class="row">

                    <ul>
                        <?php
                            $sql = "SELECT NEWS_DATE, TITLE_NEWS, NEWS_DETAIL FROM news";
                            $res = mysqli_query($conn,$sql);

                         echo "<ul>";
                        while($row = mysqli_fetch_assoc($res)) {
                          $count++;


                          $newsDate = $row['NEWS_DATE'];
                          $newsDate = date('d/m/Y', strtotime(str_replace('/', '-',$newsDate)));
                          $newsDate = date('l , d F Y', strtotime(str_replace('/', '-',$newsDate)));

                          echo "<li>";
                          echo "<div class='col-md-12' align='left'>";
                          echo "<h4><strong>". $row['TITLE_NEWS']."</strong></h4>";
                          echo "<P>". $row['NEWS_DETAIL'] ."</P>";
                          echo "<P>". $newsDate."</P>";
                          echo "</div>";
                          echo "</li>";

                        }

                        echo "</ul>";
                        ?>
                     <!--    <li>
                             <div class="col-md-12" align="left">
                                <h4 ><strong>Deadline of project proposal</strong></h4>
                                <p >
                                To allow studentss to find counselors to confirm the topic that will make and write layout project proposal.
                                </p>
                                <p>update 11/02/2016 time 04:30 PM.</p>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-12" align="left">
                                <h4 align="left"><strong>Group list and advisor</strong></h4>
                                <p>
                                Post a list of counselors to allow students to find the conselors to talk about the topic and the layout again.
                                </p>
                                <p> update 22/01/2016 time 11:50 PM.</p>
                            </div>
                        </li>         -->
                    </ul>


                </div>

        </div>

    </div> <!-- /container -->


</body>
</html>
