<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

$error = false;
if(isset($_POST['btn-submit'])) {


    $RANK_1 = trim($_POST['RANK_1']);
    $RANK_1 = strip_tags($RANK_1);
    $RANK_1 = htmlspecialchars($RANK_1);

    $RANK_2 = trim($_POST['RANK_2']);
    $RANK_2 = strip_tags($RANK_2);
    $RANK_2 = htmlspecialchars($RANK_2);

    $RANK_3 = trim($_POST['RANK_3']);
    $RANK_3 = strip_tags($RANK_3);
    $RANK_3 = htmlspecialchars($RANK_3);

    $RANK_4 = trim($_POST['RANK_4']);
    $RANK_4 = strip_tags($RANK_4);
    $RANK_4 = htmlspecialchars($RANK_4);

    $RANK_5 = trim($_POST['RANK_5']);
    $RANK_5 = strip_tags($RANK_5);
    $RANK_5 = htmlspecialchars($RANK_5);


    $RANK_6 = trim($_POST['RANK_6']);
    $RANK_6 = strip_tags($RANK_6);
    $RANK_6 = htmlspecialchars($RANK_6);


    $RANK_7 = trim($_POST['RANK_7']);
    $RANK_7 = strip_tags($RANK_7);
    $RANK_7 = htmlspecialchars($RANK_7);

    $RANK_8 = trim($_POST['RANK_8']);
    $RANK_8 = strip_tags($RANK_8);
    $RANK_8 = htmlspecialchars($RANK_8);


    // echo $projectTitleEng;
    // echo $projectTitleTh;
    // echo $projectType;
    // echo $InputName;
    // echo $InputName2;
    // echo $InputName3;
    // echo $projectAdvisor;
    // echo $projectCoAdvisor ;

    // echo is_bool($projectTitleEng);
    // echo $projectTitleTh;
    // echo $projectType;
    // echo $projectAdvisor;

    if(empty($RANK_1)) {

        $error = true;
        $RANK_1Error = "Please Select";
    }

		if(empty($RANK_2)) {

				$error = true;
				$RANK_2Error = "Please Select";
		}

		if(empty($RANK_3)) {

				$error = true;
				$RANK_3Error = "Please Select";
		}

		if(empty($RANK_4)) {

				$error = true;
				$RANK_4Error = "Please Select";
		}

		if(empty($RANK_5)) {

				$error = true;
				$RANK_5Error = "Please Select";
		}

		if(empty($RANK_6)) {

				$error = true;
				$RANK_6Error = "Please Select";
		}

		if(empty($RANK_7)) {

				$error = true;
				$RANK_7Error = "Please Select";
		}

		if(empty($RANK_8)) {

				$error = true;
				$RANK_8Error = "Please Select";
		}


    // if(empty($projectCoAdvisor)) {

    //     $error = true;
    //     $projectCoAdvisorError = "Input Data Announced";
    // }
    //$error = false;
    // echo  $error;

    if(!$error) {

        $sql = "INSERT INTO lec_rank(
														RANK_1,
														RANK_2,
														RANK_3,
														RANK_4,
														RANK_5,
														RANK_6,
														RANK_7,
														RANK_8,
														)
														VALUES(
														'$RANK_1',
														'$RANK_2',
														'$RANK_3',
														'$RANK_4',
														'$RANK_5',
														'$RANK_6',
														'$RANK_7',
														'$RANK_8'
														)";

        mysqli_query($conn,$sql);

        $msgSuccess = "Complete";
        $btnBack = "home.php";

    }

}

if (isset($_POST['btn-cancle'])) {

    echo "<script> window.location.href = 'home.php' </script>";
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undergraduate</title>

	<?php include'fragment/headerScript.php' ?>

  <style type="text/css">
    li {list-style:none;}
  </style>



</head>
<body>

	<?php include 'fragment/navbar.php'; ?>

	<div class="container">
			<h3>ADD RANK</h3><hr>

			<?php
					if(isset($msgSuccess)) {
							echo '<div class="alert alert-success" role="alert">';
							echo $msgSuccess ;
							echo ' Back To Before ';
							echo '<a href="'. $btnBack .'" class="alert-link" style="padding: 0 10px;"> Click </a>';
							echo '</div>';
					}

			?>

			<form class="form-horizontal row" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

					<div class="form-group">
							<label for="RANK_1" class="control-label col-md-3"> RANK1 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_1" name="RANK_1">
											<option value="">SELECT</option>
											<option value="1">AR</option>
											<option value="2">Chatbot</option>
											<option value="3">Database</option>
											<option value="4">Datamining</option>
											<option value="5">Health</option>
											<option value="6">IoT</option>
											<option value="7">IS</option>
											<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_1Error))  echo '<span class="" >'.$RANK_1Error ."</span>"  ?>
					</div>
					<div class="form-group">
							<label for="RANK_2" class="control-label col-md-3"> RANK2 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_2" name="RANK_2">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_2Error))  echo '<span class="" >'. $RANK_2Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_3" class="control-label col-md-3"> RANK3 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_3" name="RANK_3">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_3Error))  echo '<span class="" >'. $RANK_3Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_4" class="control-label col-md-3"> RANK4 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_4" name="RANK_4">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_4Error))  echo '<span class="" >'. $RANK_4Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_5" class="control-label col-md-3"> RANK5 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_5" name="RANK_5">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_5Error))  echo '<span class="" >'. $RANK_5Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_6" class="control-label col-md-3"> RANK6 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_6" name="RANK_6">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_6Error))  echo '<span class="" >'. $RANK_6Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_7" class="control-label col-md-3"> RANK7 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_7" name="RANK_7">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_7Error))  echo '<span class="" >'. $RANK_7Error ."</span>"  ?>
					</div>

					<div class="form-group">
							<label for="RANK_8" class="control-label col-md-3"> RANK8 : </label>
							<div class="col-md-3">
									<select class="form-control" id="RANK_8" name="RANK_8">
										<option value="">SELECT</option>
										<option value="1">AR</option>
										<option value="2">Chatbot</option>
										<option value="3">Database</option>
										<option value="4">Datamining</option>
										<option value="5">Health</option>
										<option value="6">IoT</option>
										<option value="7">IS</option>
										<option value="8">Network</option>
								 </select>
							</div>
								 <?php if(isset($RANK_8))  echo '<span class="" >'. $RANK_8Error ."</span>"  ?>
					</div>


					<div class="form-group">
							<div class="col-sm-offset col-sm-10" align="center">
									<button type="submit" class="btn btn-primary" name="btn-submit" >SAVE</button>
									<button type="submit" class="btn btn-default" name="btn-cancle" >CANCLE</button>
							</div>
					</div>

			<form>

	</div> <!-- /container -->





</body>
</html>
