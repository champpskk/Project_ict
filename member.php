<?php 
require_once 'config/dbconfig.php';

$count = 0;

if(isset($_GET['group'])) {
  $vaGroup = trim($_GET['group']);
}else{
  $vaGroup = 'Admin';
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
    .btn-group {
      background: #20B2AA;
      border: 1px solid #008000;
      color: #FFFACD;
    }

    .btn-year {
      background: #515151;
      border: 1px solid #F5F5F5;
      color: #FFFACD;
    }

    .btn-year:hover {
      border: 1px solid #c0c0c0;
      color: #515151;
      background: #E9E9E9;
    }

  </style>
  
</head>
<body>
	
	<?php include 'fragment/navbar.php'; ?>
<div class="container">
     <h3>MEMBER</h3><hr>
          <div class="form-group">
            <div class=""  style="margin-bottom: 10px;">
              <a class="btn btn-year" href="#">Year 2016</a>
              <a class="btn btn-year" href="#">Year 2017</a>
              <hr>
            </div>            
          </div>
          <div class="form-group">
            <div class=""  style="margin-bottom: 10px;">
              <a class="btn btn-group" href="member.php?group=Student">STUDENTS GROUP</a>
              <a class="btn btn-group" href="member.php?group=Lecturer">LECTURER GROUP</a>
              <a class="btn btn-group" href="member.php?group=ModuleLeader">MODULE LEADER GROUP</a> 
              <a class="btn btn-group" href="member.php?group=Admin">ADMIN GROUP</a>
              <a class="btn btn-group" href="member.php?group=Other">OTHER GROUP</a>                 
            </div>            
          </div>
          


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" align="right" style="margin-bottom: 10px;">
              <a class="btn btn-primary" href="add_student.php">ADD STUDENT</a>            
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" align="right" style="margin-bottom: 10px;">
              <a class="btn btn-primary" href="add_lecturer.php">ADD LECTURER</a>            
            </div>
          </div>

          
            <table class="table table-bordered" style="margin-top: 40px;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>USERNAME</th>                  
                  <th>GROUP</th>
                  <th>ISID</th>
                  <th>CHANGE</th>
                  
                </tr>
              </thead>
             
            <?php

          if($vaGroup == 'Other') {
            $sql = "SELECT USER_ID, 
                        USER_NAME,
                        USER_GROUP,
                        USER_ISID
                        FROM users WHERE USER_GROUP != 'Student' AND USER_GROUP != 'Lecturer' AND USER_GROUP != 'ModuleLeader' AND USER_GROUP != 'Admin'";  
          }else{ 
           
          $sql = "SELECT USER_ID, 
                        USER_NAME,
                        USER_GROUP,
                        USER_ISID
                        FROM users WHERE USER_GROUP = '$vaGroup' ";
          }

          $res = mysqli_query($conn,$sql);        
         
                  if(mysqli_num_rows($res) == 0) {
                    
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>1</th>";
                        
                        echo "<td></td>";
                        echo "<td>";
                        // echo "<i class='fa fa-times' aria-hidden='true'></i>"; 
                        // echo "<i class='fa fa-pencil-square-o' aria-hidden='true'></i>";
                        echo "</td>";
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
                      echo "<td>".$row['USER_NAME']."</td>";
                      echo "<td>".$row['USER_GROUP']."</td>";
                      echo "<td>".$row['USER_ISID']."</td>";
                      

                      // echo "<td><a href='project.php?id=" . $row['PROJ_ID']. "'>". $row['PROJ_NAME_ENG']."</a></td>";
                      // echo "<td><span style='display:block;'>". $stu_name1 ."</span><span style='display:block;'>". $stu_name2 ."</span><span style='display:block;'>". $stu_name3 ."</span></td>";
                      // echo "<td><span style='display:block;'>". $lec_name ."</span><span style='display:block;'>". $lec_name2 ."</span> </td>";
                      echo "<td>";
                      echo "<span style='padding:5px;'><button class='btn btn-danger' id='mem_del".$row['USER_ID']."' onclick='delMember(".$row['USER_ID'].")' >DEL</button></span>"; 
                      echo "<span style='padding:5px;'><a class='btn btn-success' href='member_edit.php?id=".$row['USER_ID']."'>EDIT</span>";
                      // echo "</td>";
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
  
delMember = function(id) {    
    var $ele = $('#mem_del'+id).parent().parent().parent().parent();
    // alert($ele);
    // console.log($ele);
    //$ele.fadeOut().remove();
    $.ajax({
        type:'POST',
        url:'delete.php',
        data:{'user_id':id},
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