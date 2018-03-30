<?php

require_once 'config/dbconfig.php';

if(isset($_GET['id'])) {

	$id = trim($_GET['id']);

	$sql = "SELECT EVENT_ID, EVENT_TITLE, EVENT_DATE_BEGIN, EVENT_TIME_BEGIN , EVENT_DATE_DUE , EVENT_TIME_DUE FROM events WHERE EVENT_ID = ".$id;
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);

	$vaEventTitle = $row['EVENT_TITLE'];

	$sql = "SELECT count(AC_ID) AS Count_AC_ID,count(PRO_ID) AS Count_PRO_ID FROM sent_activity WHERE EVENT_ID = ". $id ." AND AC_STATUS = 1";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);

	$vaCountRow = $row['Count_AC_ID'];

    $vaCountProj = $row['Count_PRO_ID'];

    $sql = "SELECT count(PROJ_ID) AS Count_PROJ_ID FROM project ";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);

    $vaCountProjAll = $row['Count_PROJ_ID'];
    $vaMaxRow = $vaCountProjAll;



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
		#container {
		    height: 400px;
		    min-width: 310px;
		    max-width: 800px;
		    margin: 0 auto;
		}
		#chart {
		    height: 400px;
		    min-width: 310px;
		    max-width: 800px;
		    margin: 0 auto;
		}
	</style>
</head>
<body>
<?php include 'fragment/navbar.php'; ?>
<div id="chart" style="width:100%; height:400px;"></div>
<div class="container">
    <a href="chart.php" class="btn btn-primary">BACK</a>

</div>

<script type="text/javascript">

	$('#chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: <?php echo "'". strtoupper($vaEventTitle) ."'"?>
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'SEND (<?php echo $vaCountProj;  ?> Group) ',
                y: <?php echo $vaCountRow ;  ?>
            }, {
                name: 'NOT SEND (<?php echo $vaCountProjAll-$vaCountProj ?> Group) ',
                y: <?php echo $vaMaxRow-$vaCountRow; ?>
            }]
        }]
    });


</script>
</body>
</html>
