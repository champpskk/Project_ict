<?php

require_once 'config/dbconfig.php';

$sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN , EVENT_DATE_DUE , EVENT_TIME_DUE FROM events";
$res = mysqli_query($conn,$sql);




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
    .btn-View {
      background-color: #5F9EA0;
      color: #fff;
      border-color: #122b40;
    }
    .btn-View:hover {
    color: #5F9EA0;
    background-color: #fff;
    border-color: #204d74;
}
  </style>
</head>
<body>
<?php include 'fragment/navbar.php'; ?>
<div class="container">
<h3>Chart</h3><hr>
<table class="table table-bordered" style="margin-top: 40px;">
          <thead>
            <tr>
              <th width="2%">#</th>
              <th>TITLE</th>
              <th width="25%" >A pie chart of activities</th>
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
                        echo "</tr>";
                        echo "</tbody>";


                  }else{
                    $count = 0;
                    while($row = mysqli_fetch_assoc($res)) {
                      $count++;

                      echo "<tbody>";
                      echo "<tr>";
                      echo "<th scope='row'>". $count ."</th>";
                      echo "<td>".$row['EVENT_TITLE']."</td>";
                      echo "<td align='center'><a class='btn btn-View' href='showchart.php?id=".$row['EVENT_ID']."'>View</a></td>";
                      echo "</tr>";
                      echo "</tbody>";
                    }

                  }

                ?>

        </table>
</div>
</body>
</html>
