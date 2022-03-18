<?php

session_start();

date_default_timezone_set('Asia/Manila');

if ($_POST) {
	$date = null;

	if (isset($_POST['date'])) {
		// Selected date
		$date = (new DateTime($_POST['date']))->format("Y-m-d");
	} else {
		// Today
		$date = date("Y-m-d");
	}

	require_once(__DIR__ . "/../plugins/FPDF/fpdf.php");

	$fpdf = new FPDF('P', 'mm', 'A4');

	$fpdf->SetTitle("Daily Report");

	$fpdf->AddPage("P"); //275

	$fpdf->SetFont("Arial", "b", 25);
	$fpdf->Cell(0, 15, "DAILY CASH SUMMARY REPORT", 0, 1, "C");

	$fpdf->SetFont("Arial", "", 12);

	$fpdf->Cell(90, 7, "DATE", 1, 0);
	$fpdf->Cell(90, 7, (new DateTime($date))->format("M d, Y"), 1, 1);

	$fpdf->SetFont("Arial", "b", 12);
	$fpdf->SetFillColor(213,220,228);
	$fpdf->Cell(180, 7, "Quantity of Rented Taxi", 1, 1, "C", TRUE);

	$fpdf->SetFont("Arial", "", 12);

	// Taxi class in list
	require_once(__DIR__ . "/db.php");

	$DB = DB();

	$query = "
				SELECT `taxi_class`.`tc_text` as taxi_class, count(*) as in_taxi_count 
					FROM `in_out`,`taxi`,`taxi_class` 
					WHERE `in_out`.`t_id` = `taxi`.`t_id` and `taxi`.`tc_id` = `taxi_class`.`tc_id`
					and `in_out`.`out_time` <> '0000-00-00 00:00:00'
					and `in_out`.`out_time` between '" . $date . " 00:00:00' and '" . $date . " 23:59:59'
					group by `taxi`.`tc_id`";

	$selectQuery = $DB->prepare($query);
	$selectQuery->execute();

	$results = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

	foreach ($results as $result) {
		$fpdf->Cell(90, 7, $result["taxi_class"], 1, 0);
		$fpdf->Cell(90, 7, $result["in_taxi_count"], 1, 1);
	}

	require_once(__DIR__ . "/getDailyReport.php");

	$dailyReport = getDailyReport($date, "All");

	$fpdf->SetFont("Arial", "b", 12);
	$fpdf->SetFillColor(213,220,228);
	$fpdf->Cell(180, 7, "Total Gas", 1, 1, "C", TRUE);

	$fpdf->SetFont("Arial", "", 12);

	// Gas
	$fpdf->Cell(90, 7, "Gas Price Today", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["currentGasPrice"], 1, 1);

	$fpdf->Cell(90, 7, "Quantity (Liters)", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalGasLitersPaidOrNot"], 1, 1);

	$fpdf->Cell(90, 7, "Amount", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalGasAmountPaidOrNot"], 1, 1);

	$fpdf->Cell(90, 7, "Quantity (Liters) Paid From Current/Before", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalGasLiters"], 1, 1);

	$fpdf->Cell(90, 7, "Amount Paid From Current/Before", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalGasAmount"], 1, 1);

	// Rental
	$fpdf->Cell(90, 7, "", 1, 0);
	$fpdf->Cell(90, 7, "", 1, 1);

	$fpdf->Cell(90, 7, "Total Rental Amount", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalRentalAmount"], 1, 1);

	// Cash Bond
	$fpdf->Cell(90, 7, "Total Cash Bond", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalCashBond"], 1, 1);

	// sss etc..
	$fpdf->Cell(90, 7, "Total SSS/PHIC/HDMF", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalSSSPHICHDMF"], 1, 1);

	// Car Wash
	$fpdf->Cell(90, 7, "Total Car Wash", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalCarWash"], 1, 1);

	// Others
	$fpdf->Cell(90, 7, "Total Others Collections", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalOthersAmount"], 1, 1);

	// Others Products
	$fpdf->Cell(90, 7, "Total Others Products", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalOtherProducts"], 1, 1);

	// Others
	$fpdf->Cell(90, 7, "Total Discounts", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalDiscountAmount"], 1, 1);

	$fpdf->Cell(90, 7, "", 1, 0);
	$fpdf->Cell(90, 7, "", 1, 1);

	// Balance
	$fpdf->Cell(90, 7, "Total Shortage", 1, 0);
	$fpdf->Cell(90, 7, $dailyReport["totalBalance"], 1, 1);

	$fpdf->SetFillColor(213,220,228);
	$fpdf->Cell(90, 7, "GRAND TOTAL", 1, 0, "", TRUE);
	$fpdf->Cell(90, 7, $dailyReport["grandTotal"], 1, 1);

	// Cashier
	$fpdf->Cell(180, 7, "", 0, 1);
	$fpdf->Cell(180, 7, "", 0, 1);

	$fpdf->Cell(43,7,"CASHIER ON DUTY:",0,0);
	$fpdf->Cell(100,7,$_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'],"B",1, "L");

	$fpdf->Cell(180, 7, "", 0, 1);
	$fpdf->Cell(180, 7, "", 0, 1);

	$fpdf->SetFont("Arial", "", 10);
	$fpdf->Cell(180, 7, "Generated Date: " . (new DateTime())->format('l, M d, Y h:i a'), 0,0, "C");

	$fpdf->output();
} else {
	header("location:index.php");
}
