

<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_POST["btn-submit"]))
{

	set_time_limit(0);
	header('Content-Type: text/html; charset=utf-8');

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

	//$filename = $_FILES['fileToUpload']['tmp_name'];

	//$file = fopen($filename, "r");

	//echo $filename;

	$inputFileName = $target_file;
	// "student.xlsx"
	require_once 'Classes/PHPExcel.php';
	include 'Classes/PHPExcel/IOFactory.php';

	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	 {
	      $highestRow = $worksheet->getHighestRow();
	      for ($row=3; $row<=$highestRow; $row++)
	      {

	           	// echo $lec_id = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
	            // echo $lec_name = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
	            // echo $lec_gender = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
	            // echo $lec_age = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
	            // echo $lec_fac = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
	            // echo $lec_major = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue());

	      		$lec_id = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
	            $lec_name = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
	            $lec_gender = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
	            $lec_age = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
	            $lec_fac = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
	            $lec_major = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue());




	           $sql = "INSERT INTO lecturers ( LEC_ID,LEC_NAME,LEC_GENDER,LEC_AGE,LEC_FAC,LEC_MAJOR)
	                   VALUES ('".$lec_id."', '".$lec_name."', '".$lec_gender."', '".$lec_age."', '".$lec_fac."' , '".$lec_major."')";
	           mysqli_query($conn, $sql);

		        // $resultUserGroupArray = explode(' ',$lec_name,3);
            //
            //
	          //   $resultName = trim($resultUserGroupArray[1]);
	          //   $resultName = strtolower($resultName);


	           $sql2 = "INSERT INTO users (USER_ID,USER_NAME,USER_PASS,USER_GROUP,USER_ISID)
	                   VALUES ('".$lec_id."','".$lec_name."', '".$lec_name."', 'Lecturer', '".$lec_id."' )";
	           mysqli_query($conn, $sql2);
	      }
	 }

	 unlink($target_file);

	 if(isset($target_file)){
	 	$check = 'SECCESS IMPORT';
	 }else{
	 	$check = 'FAIL!';
	 }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> </title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>

	<?php include 'fragment/navbar.php'; ?>
  <div class="container">
      <h3> ADD LECTURER </h3><hr>
      <p>
        <h4 align="center" style="margin-top: 40px;"><strong>
			<?php
				if(isset($check)){
					echo $check;
				}
				//echo 'ใกล้เสร็จแล้ว';
			 ?>

        </strong></h4>
      </p>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label col-md-3" for="fileToUpload" ></label>
          <div class="col-md-6" align="center">
              <input type="file" id="fileToUpload" name="fileToUpload" style="margin-top:100px;" >


              <button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="btn-submit">Import file</button>
          </div>


        </div>
      </form>




</body>
</html>
