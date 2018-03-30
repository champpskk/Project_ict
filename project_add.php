<?php
require_once 'config/dbconfig.php';

$error = false;
if(isset($_POST['btn-submit'])) {


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
    //$error = false;
    // echo  $error;

    if(!$error) {

        $sql = "INSERT INTO project(
                        PROJ_NAME_ENG,
                        PROJ_NAME_TH,
                        PROJ_TYPE_ID,
                        STD_ID_1,
                        STD_ID_2,
                        STD_ID_3,
                        LEC_ID_1,
                        LEC_ID_2)
                        VALUES(
                        '$projectTitleEng',
                        '$projectTitleTh',
                        '$projectType',
                        '$InputName',
                        '$InputName2',
                        '$InputName3',
                        '$projectAdvisor',
                        '$projectCoAdvisor'
                        )

         ";

        mysqli_query($conn,$sql);

        $msgSuccess = "Complete";
        $btnBack = "project.php";

    }

}

if (isset($_POST['btn-cancle'])) {

    echo "<script> window.location.href = 'project.php' </script>";
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
        <h3>ADD PROJECT</h3><hr>

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
                    <input type="text" class="form-control" id="projectTitleEng" name="projectTitleEng" placeholder="PROJECT TITLE ( ENG )">
                </div>
                <?php if(isset($projectTitleEngError))  echo '<span class="" >'. $projectTitleEngError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3" for="projectTitleTh" > PROJECT TITLE ( Thai ) : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectTitleTh" name="projectTitleTh" placeholder="PROJECT TITLE ( Thai )">
                </div>
                <?php if(isset($projectTitleThError))  echo '<span class="" >'. $projectTitleThError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label for="projectType" class="control-label col-md-3"> TYPE OF PROJECT : </label>
                <div class="col-md-3">
                    <select class="form-control" id="projectType" name="projectType">
                        <option value="">SELECT</option>
                        <option value="WA">Web Application</option>
                        <option value="MA">Mobile Application</option>
                        <option value="All">All</option>
                   </select>
                </div>
                   <?php if(isset($projectTypeError))  echo '<span class="" >'. $projectTypeError ."</span>"  ?>
            </div>
            <div class="form-group">
                <label for="projectDevName" class="control-label col-md-3"> DEVELOPER NAME : </label>
                <div class="col-md-3">
                    <ol class="list-group">
                        <li >
                            <input type="text" class="form-control" id="InputName" name="InputName">
                            <input type="hidden" class="form-control" id="InputNameId" name="InputNameId">
                        </li>

                        <li >
                            <input type="text" class="form-control" id="InputName2" name="InputName2" >
                            <input type="hidden" class="form-control" id="InputNameId2" name="InputNameId2" >
                        </li>
                        <li >
                            <input type="text" class="form-control" id="InputName3" name="InputName3">
                            <input type="hidden" class="form-control" id="InputNameId3" name="InputNameId3" >
                        </li>
                    </ol>
                 </div>
                 <?php if(isset($prijectInputNameIdError))  echo '<span class="" >'. $prijectInputNameIdError ."</span>"  ?>

            </div>

            <div class="form-group">
                <label class="control-label col-md-3" for="projectAdvisor" >ADVISOR : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectAdvisor" name="projectAdvisor" >
                    <input type="hidden" class="form-control" id="projectAdvisorId" name="projectAdvisorId" >
                </div>
                <?php if(isset($projectAdvisorError))  echo '<span class="" >'. $projectAdvisorError ."</span>"  ?>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3" for="projectCoAdvisor" >CO-ADVISOR : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="projectCoAdvisor" name="projectCoAdvisor"  >
                    <input type="hidden" class="form-control" id="projectCoAdvisorId" name="projectCoAdvisorId"  >
                </div>

            </div>



            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" align="center">
                    <button type="submit" class="btn btn-primary" name="btn-submit" >SAVE</button>
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


            $("#InputNameId3").val(selectedItemValue).trigger("change");
        },
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
