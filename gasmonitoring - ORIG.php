<?php


session_start();

include("includes/isloggedin.php");

if (ISLOGGEDIN() == true) {
	if (ISGASMONITORING() == true) {
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

	<title>Taxi System - Gas Monitoring</title>

	<?php include("includes/head.php");
	PRINT_HEAD(); ?>

	<link rel='stylesheet' href='css_/admin.css'>


</head>


<body>

	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>


	<br>
	<br>
	<br>


	<div class='container'>

		<h4><b>Add New Reading</b></h4>


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

		<form action='functions/gasmonitoring_add.php' method='post'>
			<div class='form-group'>
				<label>Gas Liters</label>
				<input type='number' step="any" name='amount_tb' class='form-control' value="0" requried />
			</div>

			<div class='form-group'>
				<p>Tank Number</p>

				<input type="radio" id="1" name="tank_no_tb" value="1" required>
				<label for="1">1</label>

				<input type="radio" id="2" name="tank_no_tb" value="2" required>
				<label for="2">2</label>
			</div>

			<div class='form-group'>
				<input type='submit' class='form-control' value='Add Reading' />
			</div>

		</form>

		<br>

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

		<table class='table table-striped'>

			<thead>
				<tr>
					<th>Date</th>
					<th>Tank No</th>
					<th>First Read</th>
					<th>First Read Time</th>
					<th>Last Read</th>
					<th>Last Read Time</th>
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

		<table class='table table-striped'>

			<thead>
				<tr>
					<th>Date</th>
					<th>Tank No</th>
					<th>First Read</th>
					<th>First Read Time</th>
					<th>Last Read</th>
					<th>Last Read Time</th>
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

</body>


</html>