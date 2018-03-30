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

    $sql = "SELECT USER_ID, USER_NAME, USER_PASS FROM users WHERE USER_ID = $id ";

    $res = mysqli_query($conn,$sql);
    // echo mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);

    $resultUserId = $row['USER_ID'];
    $resultUserName = $row['USER_NAME'];
    $resultUserPass = $row['USER_PASS'];


}

$error = false;
if(isset($_POST['btn-submit'])) {

    $id = trim($_POST['id']);

    $userName = trim($_POST['userName']);
    $userName = strip_tags($userName);
    $userName = htmlspecialchars($userName);

    $userPass = trim($_POST['userPass']);
    $userPass = strip_tags($userPass);
    $userPass = htmlspecialchars($userPass);


    if(empty($userName)) {

        $error = true;
        $userNameError = "Enter UserName";
    }

    if(empty($userPass)) {

        $error = true;
        $userPassError = "Enter UserPass";
    }


    if(!$error) {

    	// echo $userName;
    	// echo $userPass;
    	// echo $id;
        $sql = "UPDATE users SET
                        USER_NAME = '$userName',
                        USER_PASS = '$userPass'
                WHERE USER_ID = $id;


         ";

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
    <title>Undergraduate </title>
	<?php include'fragment/headerScript.php' ?>
</head>
<body>

	<?php include 'fragment/navbar.php'; ?>

    <div class="container">
        <h3>UPDATE PROFILE</h3><hr>

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
                <label class="control-label col-md-3" for="userName" > USER_NAME : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="userName" name="userName"  value="<?php if(isset($_GET['id']))  echo $resultUserName ;  ?>"><?php if(isset($userNameError))  echo '<span class="" >'. $userNameError ."</span>"  ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3" for="userPass" > Password </label>
                <div class="col-md-6">
                    <input type="password" class="form-control" id="userPass" name="userPass" value="<?php if(isset($_GET['id']))  echo $resultUserPass ;  ?>"> <?php if(isset($userPassError))  echo '<span class="" >'. $userPassError ."</span>"  ?>
                </div>
            </div>


            <input type="hidden" class="form-control" id="id" name="id"  value="<?php if(isset($_GET['id']))  echo $resultUserId?>">

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



});

</script>

</body>
</html>
