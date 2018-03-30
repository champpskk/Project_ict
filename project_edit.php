<?php
require_once 'config/dbconfig.php';

if(isset($_SESSION['user']) == ""){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id']) && isset($_POST['btn-submit']) ){
    echo "<script> window.location.href = 'index.php'</script>";
}

if(isset($_GET['id'])){

    $id = trim($_GET['id']);

    $sql = "SELECT PROJ_ID, PROJ_NAME_ENG, PROJ_NAME_TH, STD_ID_1, STD_ID_2, STD_ID_3, LEC_ID_1, LEC_ID_2, PROJ_TYPE_ID FROM project WHERE PROJ_ID = $id ";

    $res = mysqli_query($conn,$sql);
    // echo mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);

    $resultProJId = $row['PROJ_ID'];
    $resultProJNameEng = $row['PROJ_NAME_ENG'];
    $resultProJNameTh = $row['PROJ_NAME_TH'];
    $resultStuId_1 = $row['STD_ID_1'];
    $resultStuId_2 = $row['STD_ID_2'];
    $resultStuId_3 = $row['STD_ID_3'];
    $resultLecId_1 = $row['LEC_ID_1'];
    $resultLecId_2 = $row['LEC_ID_2'];
    $resultProJType = $row['PROJ_TYPE_ID'];

    $resStuId_1 = mysqli_query($conn,"SELECT STU_ID,STU_NAME FROM students WHERE STU_ID = '$resultStuId_1' ");
    $resStuId_2 = mysqli_query($conn,"SELECT STU_ID,STU_NAME FROM students WHERE STU_ID = '$resultStuId_2' ");
    $resStuId_3 = mysqli_query($conn,"SELECT STU_ID,STU_NAME FROM students WHERE STU_ID = '$resultStuId_3' ");


    if(isset($resStuId_1)){
       $rowStuId = mysqli_fetch_assoc($resStuId_1);
       $resultStuName_1 = $rowStuId['STU_NAME'];
    }

    if(isset($resStuId_2)){
       $rowStuId = mysqli_fetch_assoc($resStuId_2);
       $resultStuName_2 = $rowStuId['STU_NAME'];
    }

    if(isset($resStuId_3)){
       $rowStuId = mysqli_fetch_assoc($resStuId_3);
       $resultStuName_3 = $rowStuId['STU_NAME'];
    }

    $resLecId_1 = mysqli_query($conn,"SELECT LEC_ID,LEC_NAME FROM  lecturers WHERE  LEC_ID = '$resultLecId_1' ");
    $resLecId_2 = mysqli_query($conn,"SELECT LEC_ID,LEC_NAME FROM  lecturers WHERE  LEC_ID = '$resultLecId_2' ");

    if(isset($resLecId_1)){
       $rowLecId = mysqli_fetch_assoc($resLecId_1);
       $resultLecName_1 = $rowLecId['LEC_NAME']." ".$rowLecId['LEC_SUR'];
    }

    if(isset($resLecId_2)){
       $rowLecId = mysqli_fetch_assoc($resLecId_2);
       $resultLecName_2 = $rowLecId['LEC_NAME']." ".$rowLecId['LEC_SUR'];
    }
}

$error = false;
if(isset($_POST['btn-submit'])) {

    $id = trim($_POST['id']);

    $projectTitleEng = trim($_POST['projectTitleEng']);
    $projectTitleEng = strip_tags($projectTitleEng);
    $projectTitleEng = htmlspecialchars($projectTitleEng);

    $projectTitleTh = trim($_POST['projectTitleTh']);
    $projectTitleTh = strip_tags($projectTitleTh);
    $projectTitleTh = htmlspecialchars($projectTitleTh);

    $projectType = trim($_POST['projectType']);
    $projectType = strip_tags($projectType);
    $projectType = htmlspecialchars($projectType);

    $InputName = trim($_POST['InputNameId']);
    $InputName = strip_tags($InputName);
    $InputName = htmlspecialchars($InputName);

    $InputName2 = trim($_POST['InputNameId2']);
    $InputName2 = strip_tags($InputName2);
    $InputName2 = htmlspecialchars($InputName2);


    $InputName3 = trim($_POST['InputNameId3']);
    $InputName3 = strip_tags($InputName3);
    $InputName3 = htmlspecialchars($InputName3);


    $projectAdvisor = trim($_POST['projectAdvisorId']);
    $projectAdvisor = strip_tags($projectAdvisor);
    $projectAdvisor = htmlspecialchars($projectAdvisor);

    $projectCoAdvisor = trim($_POST['projectCoAdvisorId']);
    $projectCoAdvisor = strip_tags($projectCoAdvisor);
    $projectCoAdvisor = htmlspecialchars($projectCoAdvisor);

    // echo $id;
    // echo $projectTitleEng;
    // echo $projectTitleTh;
    // echo $projectType;
    // echo $InputName;
    // echo $InputName2;
    // echo $InputName3;
    // echo $projectAdvisor;
    // echo $projectCoAdvisor ;

    if(empty($projectTitleEng)) {

        $error = true;
        $projectTitleEngError = "Input Title ENG";
    }

    if(empty($projectTitleTh)) {

        $error = true;
        $projectTitleThError = "Input Title TH";
    }

    if(empty($projectType)) {

        $error = true;
        $projectTypeError = "Select Type";
    }

    if(empty($projectAdvisor)) {

        $error = true;
        $projectAdvisorError = "Input Data Advisor";
    }

    if(empty($InputName)) {

        $error = true;
        $prijectInputNameIdError = "Select equel than one name";

    }

    if(empty($projectAdvisor)) {

        $error = true;
        $projectAdvisorError = "Select Data Advisor";
    }

    // if(empty($projectCoAdvisor)) {

    //     $error = true;
    //     $projectCoAdvisorError = "Input Data Announced";
    // }

    //echo  $error;

    if(!$error) {

        $sql = "UPDATE project SET
                        PROJ_NAME_ENG = '$projectTitleEng',
                        PROJ_NAME_TH = '$projectTitleTh',
                        PROJ_TYPE_ID = '$projectType',
                        STD_ID_1 = '$InputName',
                        STD_ID_2 = '$InputName2',
                        STD_ID_3 = '$InputName3',
                        LEC_ID_1 = '$projectAdvisor',
                        LEC_ID_2 = '$projectCoAdvisor'
                WHERE PROJ_ID = $id;


         ";

        mysqli_query($conn,$sql);

        $msgSuccess = "Update Complete";
        $btnBack = "management.php";

    }

}

if (isset($_POST['btn-cancle'])) {

    echo "<script> window.location.href = 'management.php' </script>";
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
</head>
<body>

	<?php include 'fragment/navbar.php'; ?>

    <div class="container">
        <h3>UPDATE PROJECT</h3><hr>

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
            <div class="form-group" style="margin-top: 20px">
                <label class="control-label col-md-3" for="projectTitleEng" > PROJECT TITLE ( ENG ) : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectTitleEng" name="projectTitleEng" placeholder="PROJECT TITLE ( ENG )" value="<?php if(isset($_GET['id']))  echo $resultProJNameEng ;  ?>">
                </div>
                  <?php if(isset($projectTitleEngError))  echo '<span class="" >'. $projectTitleEngError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3" for="projectTitleTh" > PROJECT TITLE ( Thai ) : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectTitleTh" name="projectTitleTh" placeholder="PROJECT TITLE ( Thai )" value="<?php if(isset($_GET['id']))  echo $resultProJNameTh ;  ?>">
                </div>
                <?php if(isset($projectTitleThError))  echo '<span class="" >'. $projectTitleThError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label for="projectType" class="control-label col-md-3"> TYPE OF PROJECT : </label>
                <div class="col-md-3">
                    <select class="form-control" id="projectType" name="projectType">
                        <?php
                        echo '<option value="">SELECT</option>';
                        echo '<option value="WA"';
                        if(isset($_GET['id'])){
                          if($resultProJType == "WA"){
                            echo " selected ";
                          }
                        }
                        echo '>Web Application</option>';

                        echo '<option value="MA"';
                        if(isset($_GET['id'])){
                          if($resultProJType == "MA"){
                            echo " selected ";
                          }
                        }
                        echo '>Mobile Application</option>';

                        echo '<option value="All"';
                        if(isset($_GET['id'])){
                          if($resultProJType == "All"){
                            echo " selected ";
                          }
                        }
                        echo '>All</option>';

                        ?>
                   </select>
                </div>
                   <?php if(isset($projectTypeError))  echo '<span class="" >'. $projectTypeError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label for="projectDevName" class="control-label col-md-3"> DEVELOPER NAME : </label>
                <div class="col-md-3">
                    <ol class="list-group">
                        <li >
                            <input type="text" class="form-control" id="InputName" name="InputName" value="<?php if(isset($_GET['id']))  echo $resultStuName_1 ;  ?>">
                            <input type="hidden" class="form-control" id="InputNameId" name="InputNameId" value="<?php if(isset($_GET['id']))  echo $resultStuId_1 ;  ?>">
                        </li>

                        <li >
                            <input type="text" class="form-control" id="InputName2" name="InputName2" value="<?php if(isset($_GET['id']))  echo $resultStuName_2 ;  ?>">
                            <input type="hidden" class="form-control" id="InputNameId2" name="InputNameId2" value="<?php if(isset($_GET['id']))  echo $resultStuId_2 ;  ?>" >
                        </li>
                        <li >
                            <input type="text" class="form-control" id="InputName3" name="InputName3" value="<?php if(isset($_GET['id']))  echo $resultStuName_3 ;  ?>">
                            <input type="hidden" class="form-control" id="InputNameId3" name="InputNameId3" value="<?php if(isset($_GET['id']))  echo $resultStuId_3 ;  ?>">
                        </li>
                    </ol>
                 </div>
                   <?php if(isset($prijectInputNameIdError))  echo '<span class="" >'. $prijectInputNameIdError ."</span>"  ?>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="projectAdvisor" >ADVISOR : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectAdvisor" name="projectAdvisor" value="<?php if(isset($_GET['id']))  echo $resultLecName_1 ;  ?>">
                    <input type="hidden" class="form-control" id="projectAdvisorId" name="projectAdvisorId" value="<?php if(isset($_GET['id']))  echo $resultLecId_1 ;  ?>">
                </div>
                <?php if(isset($projectAdvisorError))  echo '<span class="" >'. $projectAdvisorError ."</span>"  ?>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3" for="projectCoAdvisor" >CO-ADVISOR : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectCoAdvisor" name="projectCoAdvisor"  value="<?php if(isset($_GET['id']))  echo $resultLecName_2 ;  ?>">
                    <input type="hidden" class="form-control" id="projectCoAdvisorId" name="projectCoAdvisorId"  value="<?php if(isset($_GET['id']))  echo $resultLecId_2 ;  ?>">
                </div>
            </div>


            <input type="hidden" class="form-control" id="id" name="id"  value="<?php if(isset($_GET['id']))  echo $id?>">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit" >UPDATE</button>
                    <button type="submit" class="btn btn-default" name="btn-cancle" >CANCLE</button>
                </div>
            </div>

        <form>

    </div> <!-- /container -->

<script type="text/javascript">

$(function () {

// var key = 'sel_name';
// var options = {
//     data: ["blue", "green", "pink", "red", "yellow"]
// };


//console.log('AA');
// $.ajax({
//         type:'POST',
//         url:'data.php',
//         data:{'key': 1},
//         dataType:'json',
//         success: function(data){
//             // console.log('AA');
//             // alert(data);
//              if(data){
//                 console.log(data);
//                 // alert(data);


//              }else{
//                     alert("can't")
//              }
//          }

//     });



var optionsInputName = {

  url: function(phrase) {
    return "data_stu.php";
  },

  getValue: function(element) {
    return element.STU_NAME;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#InputName").val();
    return data;
  },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#InputName").getSelectedItemData().STU_ID;


            $("#InputNameId").val(selectedItemValue).trigger("change");;
        },
        onHideListEvent: function() {
            var ItemValueCheck = $("#InputName").val();

            if(ItemValueCheck == ""){
                $("#InputNameId").val("");
            }
        },
        match: {
            enabled: true
        },
        maxNumberOfElements: 5,
    },

  requestDelay: 400
};

$("#InputName").easyAutocomplete(optionsInputName);

/**********************************************************/

var optionsInputName2 = {

  url: function(phrase) {
    return "data_stu.php";
  },

  getValue: function(element) {
    return element.STU_NAME;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#InputName2").val();
    return data;
  },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#InputName2").getSelectedItemData().STU_ID;


            $("#InputNameId2").val(selectedItemValue).trigger("change");
        },
        onHideListEvent: function() {
            var ItemValueCheck = $("#InputName2").val();

            if(ItemValueCheck == ""){
                $("#InputNameId2").val("");
            }
        },
        match: {
            enabled: true
        },
        maxNumberOfElements: 5,
    },

  requestDelay: 400
};

$("#InputName2").easyAutocomplete(optionsInputName2);

/**********************************************************/

var optionsInputName3 = {

  url: function(phrase) {
    return "data_stu.php";
  },

  getValue: function(element) {
    return element.STU_NAME;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#InputName3").val();
    return data;
  },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#InputName3").getSelectedItemData().STU_ID;


            $("#InputNameId3").val(selectedItemValue).trigger


        },
        // onLoadEvent: function() {
        //     var ItemValueCheck = $("#InputName3").val();

        //     if(empty(trim(ItemValueCheck))){
        //         $("#InputNameId3").val("");
        //     }
        // },
        onHideListEvent: function() {
            var ItemValueCheck = $("#InputName3").val();

            if(ItemValueCheck == ""){
                $("#InputNameId3").val("");
            }
        },
        match: {
            enabled: true
        },
        maxNumberOfElements: 5,

    },

  requestDelay: 400
};

$("#InputName3").easyAutocomplete(optionsInputName3);


/*****************************************************/
var optionsProjectAdvisor = {

  url: function(phrase) {
    return "data_lec.php";
  },

  getValue: function(element) {
    return element.LEC_NAME;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#projectAdvisor").val();

    return data;
  },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#projectAdvisor").getSelectedItemData().LEC_ID;


            $("#projectAdvisorId").val(selectedItemValue).trigger("change");
        },
        onHideListEvent: function() {
            var ItemValueCheck = $("#projectAdvisor").val();

            if(ItemValueCheck == ""){
                $("#projectAdvisorId").val("");
            }
        },
        match: {
            enabled: true
        },
        maxNumberOfElements: 5,

    },

    requestDelay: 400
};

$("#projectAdvisor").easyAutocomplete(optionsProjectAdvisor);

/*************************************************************/

var optionsProjectCoAdvisor = {

  url: function(phrase) {
    return "data_lec.php";
  },

  getValue: function(element) {
    return element.LEC_NAME;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#projectCoAdvisor").val();

    return data;
  },

  list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#projectCoAdvisor").getSelectedItemData().LEC_ID;


            $("#projectCoAdvisorId").val(selectedItemValue).trigger("change");
        },
        onHideListEvent: function() {
            var ItemValueCheck = $("#projectCoAdvisor").val();

            if(ItemValueCheck == ""){
                $("#projectCoAdvisorId").val("");
            }
        },
        match: {
            enabled: true
        },
        maxNumberOfElements: 5,

    },

  requestDelay: 400
};
$("#projectCoAdvisor").easyAutocomplete(optionsProjectCoAdvisor);

});

</script>

</body>
</html>
