<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php"><img src="img/test-logo15.png" width="50%" ></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <?php

              $resultUserGroup = $_SESSION['group'];

              $resultUserGroupArray = explode(',',$resultUserGroup,3);



              $resultUserGroup1 = $resultUserGroupArray[0];
              $resultUserGroup2 = $resultUserGroupArray[1];
              $resultUserGroup3 = $resultUserGroupArray[2];
              $resultUserGroup4 = $resultUserGroupArray[3];

              // echo $resultUserGroup1;

              if($resultUserGroup1 == 'Student' )
              {
                echo '<li><a href="project.php">Project</a></li>';
                echo '<li><a href="status.php">Status</a></li>'; //แสดง status การส่งงาน
              }
              if($resultUserGroup1 == 'ModuleLeader' )
              {
                echo '<li><a href="management.php">Management</a></li>';
                echo '<li><a href="event.php">Activities</a></li>';
                echo '<li><a href="news.php">News</a></li>';
                echo '<li><a href="chart.php">Statistic</a></li>';
                echo '<li><a href="status.php">Status</a></li>';
              }
              if($resultUserGroup1 == 'Admin' )
              {
                echo '<li><a href="member.php">Member</a></li>';
              }
              if($resultUserGroup1 == 'Lecturer' )
              {
                // echo '<li><a href="download.php">DOWNLOAD</a></li>';
                echo '<li><a href="student_list.php">Student_list</a></li>';
                echo '<li><a href="score.php">Marking</a></li>';
                echo '<li><a href="rank.php">Rank</a></li>';
              }

            ?>


          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li>
              <a>
              <?php
              if($resultUserGroup1 == 'Student' ){
                $sql = "SELECT STU_NAME FROM students WHERE STU_ID = ". $_SESSION['isid'] ."";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                echo 'Welcome : '. $row['STU_NAME'] ;
                $row = '';
              }
              if($resultUserGroup1 == 'ModuleLeader' ){
                $sql = "SELECT LEC_NAME FROM lecturers WHERE LEC_ID = ". $_SESSION['isid'] ."";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                echo 'Welcome : '. $row['LEC_NAME'] ;
                $row = '';
              }
              if($resultUserGroup1 == 'Lecturer' ){
                $sql = "SELECT LEC_NAME FROM lecturers WHERE LEC_ID = ". $_SESSION['isid'] ."";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                echo 'Welcome : '. $row['LEC_NAME'] ;
                $row = '';
              }
              if($resultUserGroup1 == 'Admin' ){


                if(isset($_SESSION['isid']) == 1) {
                  echo 'Welcome : Admin' ;
                }else{
                  $sql = "SELECT LEC_NAME FROM lecturers WHERE LEC_ID = ". $_SESSION['isid'] ."";
                  $res = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($res);

                  echo 'Welcome : '. $row['LEC_NAME'];
                }

                // $row = '';
              }

              ?>

              </a>
            </li>
          	<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php?id=<?php echo $_SESSION['user']?>">Profile</a></li>
                <?php
                    if(count($resultUserGroupArray) == 2)
                    {
                        echo '<li role="separator" class="divider"></li>';
                        echo '<li><a href="change_group.php?id='.$_SESSION['user'].'&group='.$resultUserGroup2.'">'.$resultUserGroup2.' View </a></li>';
                    }
                    if(count($resultUserGroupArray) == 3)
                    {
                        echo '<li role="separator" class="divider"></li>';
                        echo '<li><a href="change_group.php?id='.$_SESSION['user'].'&group='.$resultUserGroup2.'">'.$resultUserGroup2.' View </a></li>';
                        echo '<li><a href="change_group.php?id='.$_SESSION['user'].'&group='.$resultUserGroup3.'">'.$resultUserGroup3.' View </a></li>';
                    }
                ?>
                <li role="separator" class="divider"></li>
                <li><a href="sign_out.php">Sign Out</a></li>
              </ul>

            </li>

            <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
