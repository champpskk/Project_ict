<?php 
require_once 'config/dbconfig.php';

$error = false;



if(isset($_POST['btn-submit'])) {   
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    // $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $filename = basename($_FILES["file"]["name"]);
    
    $dateBegin = trim($_POST['dateBegin']);
    // $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1', $dateBegin);
    // $time = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$4', $dateBegin);   
    // $timestring = strftime('%H:%M:%S', strtotime($time));    
    // $dateBegin = $date." ".$timestring;
    $dateBegin = date('Y-m-d',strtotime(str_replace('/', '-',$dateBegin)));
    $dateBegin = htmlspecialchars($dateBegin);

    $dateDue = trim($_POST['dateDue']);
    // $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1', $dateDue);
    // $time = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$4', $dateDue);   
    // $timestring = strftime('%H:%M:%S', strtotime($time));    
    // $dateDue = $date." ".$timestring;
    $dateDue = date('Y-m-d',strtotime(str_replace('/', '-',$dateDue)));
    $dateDue = htmlspecialchars($dateDue);
    
    
    $timeBegin = trim($_POST['timeBegin']);
    $timeBegin = date('H:i:s',strtotime(str_replace('/', '-',$timeBegin)));
    $timeBegin = htmlspecialchars($timeBegin);

    $timeDue = trim($_POST['timeDue']);
    $timeDue = date('H:i:s',strtotime(str_replace('/', '-',$timeDue)));
    $timeDue = htmlspecialchars($timeDue);

    $title = trim($_POST['title']);
    $title = strip_tags($title);
    $title = htmlspecialchars($title);

    $data = trim($_POST['data']);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    

    //echo $filename;

    // echo $dateBegin." ".$timeBegin." ";
    // echo $dateDue." ".$timeDue;

    if(empty($dateBegin) && empty($timeBegin)) {
       
        $error = true;
        $date1Error = "Select Date";
    }

    if(empty($dateDue) && empty($timeDue)) {
       
        $error = true;
        $date2rror = "Select Date";
    }

    if(empty($title)) {

        $error = true;
        $titleError = "Input Title Name";
    }

    if(empty($data)) {

        $error = true;
        $dataError = "Input Data Announced";
    }

     

    if(!$error) {

        $sql = "INSERT INTO events(EVENT_TITLE,EVENT_DETAIL,EVENT_DATE_BEGIN,EVENT_TIME_BEGIN,EVENT_DATE_DUE,EVENT_TIME_DUE,EVENT_FILE) VALUES( '$title','$data','$dateBegin','$timeBegin','$dateDue','$timeDue','$filename')";

        mysqli_query($conn,$sql);

        $msgSuccess = "Complete";
        $btnBack = "event.php";
        
    }

}

if (isset($_POST['btn-cancle'])) {
    
    echo "<script> window.location.href = 'event.php' </script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EVEENTS | 1</title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>
	
	<?php include 'fragment/navbar.php'; ?>

    <div class="container">
        <h3>ADD NEW ACTIVITIES</h3><hr>

        <?php  
            if(isset($msgSuccess)) {
                echo '<div class="alert alert-success" role="alert">';
                echo $msgSuccess ;
                echo ' Back To Before ';
                echo '<a href="'. $btnBack .'" class="alert-link" style="padding: 0 10px;"> Click </a>';
                echo '</div>';
            }

        ?>
        
            
        
        <form class="form-horizontal row" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">    
        
            <div class="form-group">
                <label class="control-label col-md-3 requiredField" for="dateBegin">
                    Begin DATE : <span class="asteriskField"></span>
                </label>
                <div class="col-md-3">
                    <div class="input-group date">
                        <input type="text" class="form-control" id='dateBegin' name='dateBegin' >
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">                    
                        <input type="text" class="form-control" id='timeBegin' name='timeBegin' >                       
                    
                </div>
                <!-- <div class="col-md-3">
                    <div class='input-group date' id='dateBeginJs'>
                        <input type='text' class="form-control" id='dateBegin' name='dateBegin'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div> -->
            </div>            

            <div class="form-group">
                <label class="control-label col-md-3 requiredField" for="dateDue">
                     DUE DATE : <span class="asteriskField"></span>
                </label>
                <div class="col-md-3">
                    <div class="input-group date">
                        <input type="text" class="form-control" id='dateDue' name='dateDue'>
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">                    
                    <input type="text" class="form-control" id='timeDue' name='timeDue' >
                </div>
                <!-- div class="col-md-3">
                    <div class='input-group date' id='dateDueJs'>
                        <input type='text' class="form-control" id='dateDue' name='dateDue'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div> -->

            </div>


            
            <div class="form-group">
            <label class="control-label col-md-3" for="title" >TITLE : </label>            
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" name="title" placeholder="TITLE">               
                </div>
                <?php if(isset($titleError))  echo '<span class="" >'. $titleError ."</span>"  ?>
            </div>
            
            

            <div class="form-group">
                <label class="control-label col-md-3" for="data" >DATA ANNOUNCED : </label>            
                <div class="col-md-6">
                     <textarea  class="form-control" rows="3" name="data" id="data"></textarea>              
                </div>
                 <?php if(isset($dataError))  echo '<span class="">'. $dataError ."</span>"  ?>
            </div>     
            
            <div class="form-group">
                <label class="control-label col-md-3" for="file" >FILE : </label>            
                <div class="col-md-6">   
                    <input type="file" id="file" name="file"  >            
                </div>                 
            </div> 

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit">SAVE</button>
                    <button type="submit" class="btn btn-default" name="btn-cancle">CANCLE</button>
                </div>
            </div>

        </form>    

    </div> <!-- /container -->
  
<script type="text/javascript">

$(function () {
    // $('#dateBeginJs').datetimepicker({
    //     //format:moment().format("DD/MM/YYYY HH:MM "),
    //     //sideBySide:true,
    //     //defaultDate: moment().toDate(),
    //     minDate: new Date(),        
        
    // });
    // $('#dateBegin').datetimepicker({
    //     //format:moment().format("DD/MM/YYYY H:M  "),
    //     //sideBySide:true,
    //     defaultDate: moment().toDate(),
    //     minDate: new Date(),      
    // });
    // $('#dateDueJs').datetimepicker({
    //     //format:moment().format("DD/MM/YYYY HH:MM "),
    //     //sideBySide:true,
    //     //defaultDate: new Date(),
    //     minDate: new Date(),       
    // });
    // $('#dateDue').datetimepicker({
    //     //format:moment().format("DD/MM/YYYY HH:MM "),
    //     //sideBySide:true,
    //     defaultDate: moment().toDate(),
    //     minDate: new Date(), 
         
    // });
    // $('#dateBegin').datepicker({
    //     // format: 'dd/mm/yyyy',
    //     //startDate: '0d',
    //     autoclose: true,
    //     todayHighlight: true
    // });

    // $('#dateDue').datepicker({
    //     // format: 'dd/mm/yyyy',
    //     //startDate: '0d',
    //     autoclose: true,
    //     todayHighlight: true
    // });
    // $("#dateBegin").datepicker("setDate", new Date());
    // $("#dateDue").datepicker("setDate", new Date());

    $('#dateBegin').daterangepicker({
        singleDatePicker: true,        
        minDate: new Date(),
        locale: {
            format: 'DD/MM/YYYY'
        },        
    });

    $('#dateDue').daterangepicker({
        singleDatePicker: true,        
        minDate: new Date(),
        locale: {
            format: 'DD/MM/YYYY'
        },        
    });

    $('#timeBegin').timepicker({
        timeFormat: 'h:mm p',
        interval: 15,
        minTime: '01:00am',
        maxTime: '23:45pm',
        defaultTime: '11',
        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

     $('#timeDue').timepicker({
        timeFormat: 'h:mm p',
        interval: 15,
        minTime: '01:00am',
        maxTime: '23:45pm',
        defaultTime: '11',
        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

});

</script>
	
</body>
</html>