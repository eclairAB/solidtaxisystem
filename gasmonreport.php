<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true || ISENCODER())
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

<title>Daily Gas Monitoring - Taxi System</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>

<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: solid;
    border-width: 2px;

} 
</style>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/searchBuilder.dataTables.min.css">

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


<?php include("includes/admin_nav.php"); PRINT_NAV(); ?>

	<div class='container'>

		<h2><center><b>Daily Gas Reading</b></center></h2>
		<hr>

		<?php

		require_once("functions/db.php");

		$DB = DB();

		$query = "
					SELECT tank_no, DATE_FORMAT(monitored_date, '%Y-%m-%d') as date
					from gas_monitoring
					group by date,tank_no
					order by monitored_date desc
					";

		$selectQuery = $DB->prepare($query);
		$selectQuery->execute();

		$datesResult = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

		$finalData = array();

		foreach ($datesResult as $dateResult) {

			$firstReadQuery = "
						select gm_id,gas_amount,monitored_date from gas_monitoring where tank_no = " . $dateResult["tank_no"] . "
						and DATE_FORMAT(monitored_date, '%Y-%m-%d') = '" . $dateResult["date"] . "' order by monitored_date limit 1
						";

			$lastReadQuery = "select gm_id,gas_amount,monitored_date from gas_monitoring where tank_no = " . $dateResult["tank_no"] . "
						and DATE_FORMAT(monitored_date, '%Y-%m-%d') = '" . $dateResult["date"] . "' order by monitored_date desc limit 1
						";

			$selectQuery = $DB->prepare($firstReadQuery);
			$selectQuery->execute();

			$firstReadResult = $selectQuery->fetch(PDO::FETCH_ASSOC);

			$selectQuery = $DB->prepare($lastReadQuery);
			$selectQuery->execute();

			$lastReadResult = $selectQuery->fetch(PDO::FETCH_ASSOC);

			$lastReadTime = "N/A";

			// Remove if they are the same with first read
			if (isset($lastReadResult["gas_amount"])) {
				if ($lastReadResult["gm_id"] == $firstReadResult["gm_id"]) {
					unset($lastReadResult);
				}
			}

			if (isset($lastReadResult)) {
				$lastReadTime = (new DateTime($lastReadResult["monitored_date"]))->format("h:i a");
			}

			$dataPerDay = array(
				"date" => (new DateTime($dateResult["date"]))->format("M d, Y"),
				"tankNo" => $dateResult["tank_no"],
				"firstRead" => !isset($firstReadResult["gas_amount"]) ? 0 : $firstReadResult["gas_amount"],
				"lastRead" => !isset($lastReadResult["gas_amount"]) ? 0 : $lastReadResult["gas_amount"],
				"firstReadTime" => (new DateTime($firstReadResult["monitored_date"]))->format("h:i a"),
				"lastReadTime" => $lastReadTime,
				"consumed" => 0
			);

			if ($dataPerDay["lastRead"] != 0) {

				// Compute consumed
				$dataPerDay["consumed"] = $dataPerDay["firstRead"] - $dataPerDay["lastRead"];
			}

			array_push($finalData, $dataPerDay);
		}


		?>

		<h4><b>Tank 1</b></h4>

		<table class='table table-striped table-bordered'>

			<thead>
				<tr>
					<th>Date</th>
					<th>Tank No</th>
					<th>First Read</th>
					<th>Read Time</th>
					<th>Last Read</th>
					<th>Read Time</th>
					<th>Consumed Liters</th>
				</tr>
			</thead>

			<tbody>

				<?php
				foreach ($finalData as $data) {

					if ($data["tankNo"] == 1) {
						echo "<tr>
							<td>" . $data["date"] . "</td>
							<td>" . $data["tankNo"] . "</td>
							<td>" . $data["firstRead"] . "</td>
							<td>" . $data["firstReadTime"] . "</td>
							<td>" . $data["lastRead"] . "</td>
							<td>" . $data["lastReadTime"] . "</td>
							<td>" . $data["consumed"] . "</td>
						</tr>";
					}
				}
				?>

			</tbody>
		</table>

		<h4><b>Tank 2</b></h4>

		<table class='table table-striped table-bordered'>

			<thead >
				<tr>
					<th>Date</th>
					<th>Tank No</th>
					<th>First Read</th>
					<th>Read Time</th>
					<th>Last Read</th>
					<th>Read Time</th>
					<th>Consumed Liters</th>
				</tr>
			</thead>

			<tbody>

				<?php
				foreach ($finalData as $data) {

					if ($data["tankNo"] == 2) {
						echo "<tr>
							<td>" . $data["date"] . "</td>
							<td>" . $data["tankNo"] . "</td>
							<td>" . $data["firstRead"] . "</td>
							<td>" . $data["firstReadTime"] . "</td>
							<td>" . $data["lastRead"] . "</td>
							<td>" . $data["lastReadTime"] . "</td>
							<td>" . $data["consumed"] . "</td>
						</tr>";
					}
				}
				?>

			</tbody>
		</table>

		<script src="plugins/easy-numpad/easy-numpad.min.js"></script>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable({

            	"pageLength": 7,

            	"ordering": false,

            	"searching": true,

            	"paging": true,

            	"order": [[0, "asc"]],







            });



        });

    </script>



</body>

</html>