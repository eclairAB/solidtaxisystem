<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true)
			{

			}
			else
			{
				header("location:index.php");
			}
		}
		else
		{
			header("location:index.php");
		}

?>


<!DOCTYPE html>

<html>

<head>

<title>Taxi System - Admin</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<!-- <link rel='stylesheet' href='css/bootstrap.min.css'> -->
<link rel='stylesheet' href='css_/admin.css'>


<script type="text/javascript">
	
	$(function () {
  					$('[data-toggle="tooltip"]').tooltip()
				})
</script>

            <script src='js/Chart.bundle.js'></script>

            <style type='text/css'>
                .container1 {
                    width: 80%;
                    margin-left: 0%;



                }


            </style>

            <style type="text/css">

                .canvas {
                        background-color: #eee;

                    }

                .chart_container {
                         float: center;
                    }
                
            </style>


            <style>
                body{
                    background-color: #c7ffff;
                    overflow-x:hidden;
                }
            </style>
</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div><br>



<center>
  <button class='btn btn-primary btn-lg' onclick='window.location.href="accounts.php"' data-toggle="tooltip" data-placement="top" title="User Accounts">Accounts</button>

  <div class="btn-group" data-toggle="tooltip" data-placement="top" title="Drivers Menu">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Driver <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="driver.php">Driver Details</a></li>
      <li><a href="driverclassification.php">Driver Classifications</a></li>
      <li><a href="driver_stats.php">Driver Statistics</a></li>
    </ul>
  </div>

    <div class="btn-group" data-toggle="tooltip" data-placement="top" title="Taxi Menu">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Taxi <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="taxi.php">Taxi Details</a></li>
      <li><a href="taxiclassification.php">Taxi Classifications</a></li>
    </ul>
  </div>

	<div class="btn-group" data-toggle="tooltip" data-placement="top" title="Gas">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Gas <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="gasprice.php">Gas Price</a></li>
      <li><a href="gas_inventory.php">Gas Tank</a></li>
      <li><a href="gasmonreport.php">Daily Gas Inventory</a></li>
    </ul>
  	</div>


	<button class='btn btn-primary btn-lg' onclick='window.location.href="products.php"' data-toggle='tooltip' data-placement='top' title="Product List">Products</button>

	<button class='btn btn-primary btn-lg' onclick='window.location.href="maintenance.php"' data-toggle='tooltip' data-placement='top' title="Maintenance List">Maintenance</button>


	<button class='btn btn-primary btn-lg' onclick='window.location.href="report.php"' data-toggle='tooltip' data-placement='top' title="Generate Report">Report</button>

	<button class='btn btn-primary btn-lg' onclick='window.location.href="logs.php"' data-toggle='tooltip' data-placement='top' title="System Logs">Logs</button>
</center>




<hr>


    
<?php include("includes/chart_taxi.php");?>
        
<center>
        <div class="container1">
            <div class="row">
            <div class="col-sm-6">
            <div class="chart_container">
                <canvas id="chartTwoContainer" width="400" height="300"></canvas>
            </div></div>

            <div class="row">
            <div class="col-sm-6">
            <div class="chart_container">
                <canvas id="chartOneContainer" width="400" height="150"></canvas><br>
                <canvas id="chartThreeContainer" width="400" height="150"></canvas>
            </div></div>

        </div>
        <br><br>
</center>

<script>

        var optionsOne = {
            type: 'horizontalBar',
            data: {
                labels: [<?php while ($p = mysqli_fetch_array($tankno)) { echo '" Tank No.' . $p['tank_no'] . '",';}?>],
                datasets: [{
                        label: 'Gas Tank Inventory',
                        data: [<?php while ($p = mysqli_fetch_array($bilang)) { echo '"' . $p['totalrefill'] . '",';}?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                   
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',

                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                legend: { display: true, 
                    labels: {
                        fontColor: 'red',
                        fontSize: 16,
                        boxWidth: 0,

                    }

                }, 
                scales: {
                    xAxes: [{
                            ticks: { 
                                min: 0,
                                beginAtZero: true,
                            }
                        }]
                }
           } 
        };

        var optionsTwo = {
            type: 'bar',
            data: {
                labels: [<?php while ($p = mysqli_fetch_array($klases)) { echo '"' . $p['tc_text'] . '",';}?>],
                datasets: [{
                        label: 'Taxi Rented Today',
                        data: [<?php while ($p = mysqli_fetch_array($bilangtaxi)) { echo '"' . $p['not_available_count'] . '",';}?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(124, 162, 21, 0.2)',
                            'rgba(36, 123, 235, 0.2)',
                            'rgba(176, 59, 60, 0.2)',
                   
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(124, 162, 21, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(176, 59, 60, 1)',

                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                legend: { display: true, 
                    labels: {
                        fontColor: 'red',
                        fontSize: 16,
                        boxWidth: 0,

                    }

                }, 
                scales: {
                    yAxes: [{
                            ticks: { 
                                stepSize: 1,
                                beginAtZero: true,
                            }
                        }]
                }
           } 
        };


        var optionsThree = {
            type: 'bar',
            data: {
                labels: [<?php while ($p = mysqli_fetch_array($tankno)) { echo '"' . $p['tank_no'] . '",';}?>],
                datasets: [{
                        label: 'Another Chart',
                        data: [<?php while ($p = mysqli_fetch_array($bilang)) { echo '"' . $p['totalrefill'] . '",';}?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                   
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',

                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                legend: { display: true, 
                    labels: {
                        fontColor: 'red',
                        fontSize: 16,
                        boxWidth: 0,

                    }

                }, 
                scales: {
                    xAxes: [{
                            ticks: { 
                                min: 0,
                                beginAtZero: true,
                            }
                        }]
                }
           } 
        };

var ctxOne = document.getElementById('chartOneContainer').getContext('2d');
new Chart(ctxOne, optionsOne);

var ctxTwo = document.getElementById('chartTwoContainer').getContext('2d');
new Chart(ctxTwo, optionsTwo);

var ctx = document.getElementById('chartThreeContainer').getContext('2d');
new Chart(ctx, optionsThree);


</script>






</body>


</html>