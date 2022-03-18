<?php


session_start();

include("includes/isloggedin.php");

if (ISLOGGEDIN() == true) {
	if (ISBROADCASTER() == true) {
	} else {
		header("location:index.php");
	}
} else {
	header("location:index.php");
}

?>


<!DOCTYPE html>

<html>

<head>

	<title>Taxi Monitoring</title>

	<?php include("includes/head.php");
	PRINT_HEAD(); ?>

	<link rel='stylesheet' href='css_/admin.css'>


	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

			<style>
				body{
					background-color: #bac6d1;
					overflow-x:hidden;
				}
			</style>


</head>


<body>

	<link rel='stylesheet' href='css_/custom.css'>

	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>

	<?php include("includes/broadcaster_nav.php"); PRINT_NAV(); ?>

	<div class='container'>





		<?php
		if (isset($_SESSION['error'])) {
			echo "<br><p style='color:red'>" . $_SESSION['error'] . "</p><br>";
			unset($_SESSION['error']);
		}

		if (isset($_SESSION['success'])) {
			echo "<br><p style='color:green'>" . $_SESSION['success'] . "</p><br>";
			unset($_SESSION['success']);
		}

		?>

		<h4><b>Rented Units For Today</b></h4>

		<table class='table table-striped'>

			<thead>
				<tr>
					<th>Taxi Class</th>
					<th>Count</th>
				</tr>
			</thead>

			<tbody>

				<?php

					require_once("functions/db.php");
					
					$DB = DB();

					$query = "
					SELECT `taxi_class`.`tc_text` as taxi_class, count(*) as not_available_count 
					FROM `in_out`,`taxi`,`taxi_class` 
					WHERE `in_out`.`t_id` = `taxi`.`t_id` and `taxi`.`tc_id` = `taxi_class`.`tc_id`
					and `in_out`.`out_time` = '0000-00-00 00:00:00'
					group by `taxi`.`tc_id`";

					$selectQuery = $DB->prepare($query);
        			$selectQuery->execute();

					$results = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
					
					foreach($results as $result) {
						echo "<tr>
							<td>".$result["taxi_class"]."</td>
							<td>".$result["not_available_count"]."</td>
						</tr>";
					}

				?>

			</tbody>
		</table>
		
		<br>

		<h4><b>List of Taxi</b></h4>

		<table class='display table table-striped'>

			<thead>
				<tr>
					<th>Body no</th>
					<th>Plate no</th>
					<th>Driver</th>
					<th>Contact No</th>
					<th>Taxi Classification</th>
					<th>Rental Price</th>
					<th>Status</th>
					<th>Maintenance</th>
				</tr>
			</thead>

			<tbody>


				<?php

				require_once("functions/db.php");
				include("includes/utils.php");

				$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				$query = "select * from taxi";




				if (isset($_GET['search'])) {
					$search_this = str_replace("'", "''", $_GET['search']);

					$query = "select * from taxi where CONCAT(body_no) like '%" . $search_this . "%'";
				}








				$row = MYSQL_SELECT($query, $sess_name, 4);




				for ($x = 0; $x < $row; $x++) {

					$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

					MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=" . $_SESSION[$sess_name . '_' . $x . '_4'], $sess_name2, 1);



					$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;

					MYSQL_SELECT("select out_time from in_out where t_id=" . $_SESSION[$sess_name . '_' . $x . '_0'] . " order by io_id desc limit 1", $sess_name3, 0);


					$ok2 = true;


					if (isset($_SESSION[$sess_name3 . '_0_0'])) {
						if ($_SESSION[$sess_name3 . '_0_0'] == "0000-00-00 00:00:00") {
							$ok2 = false;
						}
					} else {


						$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;
						$row3 = 0;
						$row3 = MYSQL_SELECT("select out_time from in_out where t_id=" . $_SESSION[$sess_name . '_' . $x . '_0'], $sess_name333, 0);

						if ($row3 != 0) {
							$ok2 = false;
						}
					}






					echo "<tr>
		    		<td>" . $_SESSION[$sess_name . '_' . $x . '_1'] . "</td>
		    		<td>" . $_SESSION[$sess_name . '_' . $x . '_2'] . "</td>";




					$sess_name3331 = "data3331_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;
					MYSQL_SELECT("select driver.f_name,driver.m_name,driver.l_name,driver.contact_no from driver,in_out where driver.d_id=in_out.d_id and in_out.t_id=" . $_SESSION[$sess_name . '_' . $x . '_0'] . " order by in_out.io_id desc limit 1", $sess_name3331, 3);


					if (isset($_SESSION[$sess_name3331 . '_0_0'])) {


						echo "<td>" . $_SESSION[$sess_name3331 . '_0_0'] . " " . $_SESSION[$sess_name3331 . '_0_1'] . " " . $_SESSION[$sess_name3331 . '_0_2'] . "</td>
		    		<td>" . $_SESSION[$sess_name3331 . '_0_3'] . "</td>";
					} else {
						echo "<td>No Driver Yet</td>
		    				<td></td>";
					}






					echo "<td>" . $_SESSION[$sess_name2 . '_0_0'] . "</td>
		    		<td>" . number_format($_SESSION[$sess_name2 . '_0_1'], 2) . "</td>";

					if ($ok2 == true) {
						echo "<td style='color:green'>Available</td>";
					} else {
						echo "<td style='color:red'>Not Available</td>";
					}


					$ok3 = true;

					$sess_name3000 = "data3000_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;

					MYSQL_SELECT("select odo from taxi_change_oil where t_id=" . $_SESSION[$sess_name . '_' . $x . '_0'] . " order by tco_id desc limit 1", $sess_name3000, 0);


					if (isset($_SESSION[$sess_name3000 . '_0_0'])) {
						$sess_name3001 = "data3001_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;

						MYSQL_SELECT("select odo from gas where t_id=" . $_SESSION[$sess_name . '_' . $x . '_0'] . " order by g_id desc limit 1", $sess_name3001, 0);


						if ($_SESSION[$sess_name3001 . '_0_0'] - $_SESSION[$sess_name3000 . '_0_0'] >= 10000) {
							$ok3 = false;
						}
					}


					if ($ok3 == true) {
						echo "<td style='color:green'>OK</td>";
					} else {
						echo "<td style='color:red'>Need Change Oil</td>";
					}



					echo "
		    		</tr>";
				}

				?>


			</tbody>

		</table>


	</div>



<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('table.display').DataTable({

            	"pageLength": 15,
            	"order": [[0, "asc"]],

            	"columnDefs": [
            		{
            			"targets": 5,
            			"visible": false
            		}

            	]

            });



        });



    </script>







</body>


</html>