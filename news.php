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
             <h3>NEWS</h3><hr> 

             <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10" align="right" style="margin-bottom: 10px;">
                <a class="btn btn-primary" href="news_add.php">ADD NEWS</a>            
              </div>
            </div>         

                <table class="table table-bordered" style="margin-top: 40px;">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th width="20%">TITLE</th>
                          <th width="5%">DATE</th>
                          <th width="60%">DATA ANNOUNCED</th>
                          <th width="15%">ACTION</th>
                          <!-- <th>LAST UPDATE</th> -->
                        </tr>
                    </thead>

                <?php 
                  $sql = "SELECT NEWS_ID, NEWS_DATE, TITLE_NEWS, NEWS_DETAIL FROM news";
$res = mysqli_query($conn,$sql);

                  if(mysqli_num_rows($res) == 0) {
                    
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>1</th>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        // echo "<i class='fa fa-times' aria-hidden='true'></i>"; 
                        // echo "<i class='fa fa-pencil-square-o' aria-hidden='true'></i>";
                        echo "</td>";
                        // echo "<td></td>";
                        echo "</tr>";
                        echo "</tbody>";
                     

                  }else{
                    $count = 0;

                    while($row = mysqli_fetch_assoc($res)) {
                      $count++;

                      $resultDate= date('d/m/Y',strtotime(str_replace('/', '-', $row['NEWS_DATE'] )));
                      
                      echo "<tbody>";
                      echo "<tr>";
                      echo "<th scope='row'>". $count ."</th>";
                      echo "<td>". $row['TITLE_NEWS']."</td>";
                      echo "<td>". $resultDate  ."</td>";
                      echo "<td>". $row['NEWS_DETAIL']."</td>";
                      echo "<td>";
                      echo "<span style='padding:5px;'><button class='btn btn-danger' id='news_del".$row['NEWS_ID']."' onclick='delNews(".$row['NEWS_ID'].")' >DEL</button></span>"; 
                      echo "<span style='padding:5px;'><a class='btn btn-success' href='news_edit.php?id=".$row['NEWS_ID']."'>EDIT</span>";
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
  

  delNews = function(id) {    
    var $ele = $('#news_del'+id).parent().parent().parent().parent();
    // alert($ele);
    // console.log($ele);
    //$ele.fadeOut().remove();
    $.ajax({
        type:'POST',
        url:'delete.php',
        data:{'news_id':id},
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