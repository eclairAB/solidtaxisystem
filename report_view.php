<?php



session_start();



if ($_POST) {




	if (isset($_POST['datefrom']) && isset($_POST['taxi_classification_cb']) && isset($_POST['report_type_cb']) && isset($_POST['show_no_taxi_rented_cb'])) {




		if (!empty($_POST['datefrom'])) {







			require_once("functions/db.php");
			include("includes/utils.php");



			$from = str_replace("'", "''", $_POST['datefrom']);
			$to = str_replace("'", "''", $_POST['datefrom']);

			$_POST['taxi_classification_cb'] = str_replace("'", "''", $_POST['taxi_classification_cb']);


			if (isset($_POST['dateto'])) {

				if (!empty($_POST['dateto'])) {
					if ($_POST['datefrom'] != $_POST['dateto']) {
						$to = str_replace("'", "''", $_POST['dateto']);
					}
				}
			}



			if ($_POST['report_type_cb'] == "Daily") {

				daily($from, $to, $_POST['taxi_classification_cb']);
			}

			if ($_POST['report_type_cb'] == "Monthly") {

				if ($from == $to) {
					$_SESSION['error'] = "Dates should not be the same.";
					header("location:report.php");
				} else {
					monthly($from, $to, $_POST['taxi_classification_cb']);
				}
			}
		} else {
			$_SESSION['error'] = "Please select a date.";
			header("location:report.php");
		}
	} else {
		header("location:index.php");
	}
} else {
	header("location:index.php");
}




function daily($from, $to, $taxiclass)
{






	include("plugins/FPDF/fpdf.php");

	$fpdf = new FPDF('P', 'mm', 'A4');



	$fpdf->SetTitle("Report");


	//$fpdf->SetMargins(5, 5, 5);


	$fpdf->AddPage("L"); //275






	$fpdf->SetFont("Arial", "", 25);


	$fpdf->Cell(0, 15, "DAILY SALES REPORT", 0, 1, "C");






	$fpdf->SetFont("Arial", "", 10);


	$fpdf->Cell(10, 7, "Date:", 0, 0);

	if ($from != $to) {
		$fpdf->Cell(50, 7, DateNumToText($from) . " - " . DateNumToText($to), "B", 0);
	} else {
		$fpdf->Cell(50, 7, DateNumToText($from), "B", 0);
	}


	$fpdf->Cell(245, 10, "", 0, 1);



	$fpdf->Cell(32, 7, "Taxi Classification:", 0, 0);
	$fpdf->Cell(70, 7, $taxiclass, "B", 0);
	$fpdf->Cell(173, 10, "", 0, 1);








	if ($from != $to) {
		$query2 = "select * from billing where (b_time between '" . $from . " 00:00:00' and '" . $to . " 23:59:59') order by b_id desc";
	} else {
		$query2 = "select * from billing where b_time like '" . $from . "%' order by b_id desc";
	}



	$sess_name105 = "data105_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "111";
	$row55 = MYSQL_SELECT($query2, $sess_name105, 7);








	$rental_overall = 0;
	$gas_overall = 0;
	$gas_overallqty = 0;
	$others_overall = 0;
	$cash_remitted_overall = 0;
	$discount_overall = 0;
	$balance_overall = 0;



	for ($x = 0; $x < $row55; $x++) {








		$driver_name = "";
		$taxi_body_no = "";
		$rental = 0;
		$gas = 0;
		$others = 0;
		$cash_remitted = 0;
		$discount = 0;
		$balance = 0;


		$taxi_class_ok = true;







		//get rental taxi
		$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "1";
		$row100 = MYSQL_SELECT("select taxi.body_no,billing_taxi.t_current_rent_price,in_out.in_time,in_out.out_time,taxi.tc_id from taxi,billing_taxi,in_out where taxi.t_id=billing_taxi.t_id and in_out.b_id=billing_taxi.b_id and billing_taxi.b_id = " . $_SESSION[$sess_name105 . '_' . $x . '_0'], $sess_name100, 4);



		for ($xx = 0; $xx < $row100; $xx++) {

			if (isset($_SESSION[$sess_name100 . '_' . $xx . '_0'])) {



				if ($taxiclass != "All") {


					$sess_name11010110 = "data100110111_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $xx;
					$row100 = MYSQL_SELECT("select tc_text from taxi_class where tc_id=" . $_SESSION[$sess_name100 . '_' . $xx . '_4'], $sess_name11010110, 0);



					if ($_SESSION[$sess_name11010110 . '_0_0'] != $taxiclass) {
						$taxi_class_ok = false;
					} else {
						$taxi_class_ok = true;
					}
				}



				if ($taxi_class_ok == true) {


					$rental += $_SESSION[$sess_name100 . '_' . $xx . '_1'];
					//$rental_overall += $_SESSION[$sess_name100.'_'.$xx.'_1'];

					$taxi_body_no = $_SESSION[$sess_name100 . '_' . $xx . '_0'];
				}
			}
		}



		if ($_POST['show_no_taxi_rented_cb'] == "No") {


			if ($row100 == 0) {
				$taxi_class_ok = false;
			}
		}





		if ($taxi_class_ok == true) {






			//check if paid
			$sess_name106 = "data106_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "2";
			$row56 = MYSQL_SELECT("select amount_payed,pay_time from billing_payments where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'] . " order by b_pay_id asc", $sess_name106, 1);


			$billing_overall_total = $_SESSION[$sess_name105 . '_' . $x . '_6'] + $_SESSION[$sess_name105 . '_' . $x . '_3'] - $_SESSION[$sess_name105 . '_' . $x . '_5'];


			for ($y = 0; $y < $row56; $y++) {


				$cash_remitted += $_SESSION[$sess_name106 . '_' . $y . '_0'];
				$cash_remitted_overall += $_SESSION[$sess_name106 . '_' . $y . '_0'];
			}










			//get gas
			$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "3";
			$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'] . " order by g_id desc", $sess_name101, 2);

			for ($xxx = 0; $xxx < $row101; $xxx++) {

				if (isset($_SESSION[$sess_name101 . '_' . $xxx . '_0'])) {
					$gas += $_SESSION[$sess_name101 . '_' . $xxx . '_0'] * $_SESSION[$sess_name101 . '_' . $xxx . '_1'];
					$gas_overall += $_SESSION[$sess_name101 . '_' . $xxx . '_0'] * $_SESSION[$sess_name101 . '_' . $xxx . '_1'];
				}
			}


			//get gas qty
			/*												    	$sess_name102 = "data102_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."3";
												    	$row102 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where b_id=".$_SESSION[$sess_name105.'_'.$x.'_0']." order by g_id desc",$sess_name102,2);

												    	for($xxx=0;$xxx<$row102;$xxx++)
												    	{

													    	if(isset($_SESSION[$sess_name102.'_'.$xxx.'_0']))
													    	{
													    		$gas += $_SESSION[$sess_name102.'_'.$xxx.'_0'] * $_SESSION[$sess_name102.'_'.$xxx.'_1'];
													    		$gas_overallqty += $_SESSION[$sess_name102.'_'.$xxx.'_0'] * $_SESSION[$sess_name102.'_'.$xxx.'_1'];

													    	}
													    }*/


			//get products
			$sess_name107 = "data107_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "4";
			$row107 = MYSQL_SELECT("select p_current_name,p_current_price from billing_products where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'], $sess_name107, 1);

			for ($xxxx = 0; $xxxx < $row107; $xxxx++) {

				if (isset($_SESSION[$sess_name107 . '_' . $xxxx . '_0'])) {
					$others += $_SESSION[$sess_name107 . '_' . $xxxx . '_1'];
					$others_overall += $_SESSION[$sess_name107 . '_' . $xxxx . '_1'];
				}
			}




			if ($_SESSION[$sess_name105 . '_' . $x . '_3'] != 0) {
				$others += $_SESSION[$sess_name105 . '_' . $x . '_3'];
				$others_overall += $_SESSION[$sess_name105 . '_' . $x . '_3'];
			}


			if ($_SESSION[$sess_name105 . '_' . $x . '_5'] != 0) {

				$discount += $_SESSION[$sess_name105 . '_' . $x . '_5'];
				$discount_overall += $_SESSION[$sess_name105 . '_' . $x . '_5'];
			}



			if ($billing_overall_total != $cash_remitted) {

				$balance += $billing_overall_total - $cash_remitted;
				$balance_overall += $billing_overall_total - $cash_remitted;
			}



			if ($rental - $balance < 0) {
				$rental = 0;
			} else {
				$rental -= $balance;
			}

			$rental_overall += $rental;





			//get driver name
			$sess_name121 = "data121_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "4";
			MYSQL_SELECT("select f_name,m_name,l_name from driver where d_id=" . $_SESSION[$sess_name105 . '_' . $x . '_1'], $sess_name121, 2);


			$driver_name = $_SESSION[$sess_name121 . '_0_0'] . " " . $_SESSION[$sess_name121 . '_0_1'] . " " . $_SESSION[$sess_name121 . '_0_2'];
		}
	}






	// $fpdf->Cell(30,7,"Total Net Rental:",0,0);
	// $fpdf->Cell(39,7,number_format($rental_overall,2),"B",0);


	// $fpdf->Cell(18,7,"Total Gas:",0,0);
	// $fpdf->Cell(39,7,number_format($gas_overall,2),"B",0);


	// $fpdf->Cell(21,7,"Total Others:",0,0);
	// $fpdf->Cell(39,7,number_format($others_overall,2),"B",0);

	// $fpdf->Cell(98,10,"",0,1);



	// $fpdf->Cell(35,7,"Total Cash Remitted:",0,0);
	// $fpdf->Cell(39,7,number_format($cash_remitted_overall,2),"B",0);

	// $fpdf->Cell(25,7,"Total Discount:",0,0);
	// $fpdf->Cell(39,7,number_format($discount_overall,2),"B",0);

	// $fpdf->Cell(25,7,"Total Shortage:",0,0);
	// $fpdf->Cell(39,7,number_format($balance_overall,2),"B",0);


	// $fpdf->Cell(73,10,"",0,1);


	// $fpdf->Cell(23,7,"Overall Total:",0,0);
	// $fpdf->Cell(90,7,number_format(($rental_overall+$gas_overall+$others_overall-$discount_overall),2),"B",0);

	// $fpdf->Cell(162,30,"",0,1);


	$fpdf->SetFont("Arial", "B", 9);

	$fpdf->Cell(53, 7, "Taxi Classification", 1, 0);

	$fpdf->Cell(15, 7, "Count", 1, 1);

	$fpdf->SetFont("Arial", "", 9);

	require_once("functions/db.php");

	$DB = DB();

	$taxiClassClause = $taxiclass == "All" ? "" : "and `taxi_class`.tc_text = '" . $taxiclass . "'";

	$query = "
				SELECT `taxi_class`.`tc_text` as taxi_class, count(*) as in_taxi_count 
					FROM `in_out`,`taxi`,`taxi_class` 
					WHERE `in_out`.`t_id` = `taxi`.`t_id` and `taxi`.`tc_id` = `taxi_class`.`tc_id`
					and `in_out`.`out_time` <> '0000-00-00 00:00:00'
					and `in_out`.`out_time` between '" . $from . " 00:00:00' and '" . $to . " 23:59:59'
					" . $taxiClassClause . "
					group by `taxi`.`tc_id`";

	$selectQuery = $DB->prepare($query);
	$selectQuery->execute();

	$results = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

	foreach ($results as $result) {
		$fpdf->Cell(53, 7, $result["taxi_class"], 1, 0);
		$fpdf->Cell(15, 7, $result["in_taxi_count"], 1, 1);
	}


	$fpdf->Cell(162, 30, "", 0, 1);

	$fpdf->SetFont("Arial", "B", 9);

	$fpdf->Cell(53, 7, "Driver", 1, 0);

	$fpdf->Cell(15, 7, "Taxi #", 1, 0);

	$fpdf->Cell(17, 7, "Net Rental", 1, 0);

	$fpdf->Cell(38, 7, "Gasoline", 1, 0);

	$fpdf->Cell(38, 7, "Other Collections", 1, 0);

	$fpdf->Cell(38, 7, "Discount", 1, 0);

	$fpdf->Cell(38, 7, "Cash Remitted", 1, 0);

	$fpdf->Cell(38, 7, "Shortage", 1, 1);




	$fpdf->SetFont("Arial", "", 9);



	if ($from != $to) {
		$query2 = "select * from billing where (b_time between '" . $from . " 00:00:00' and '" . $to . " 23:59:59') order by b_id desc";
	} else {
		$query2 = "select * from billing where b_time like '" . $from . "%' order by b_id desc";
	}




	$sess_name105 = "data105_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "111";
	$row55 = MYSQL_SELECT($query2, $sess_name105, 7);










	for ($x = 0; $x < $row55; $x++) {








		$driver_name = "";
		$taxi_body_no = "";
		$rental = 0;
		$gas = 0;
		$others = 0;
		$cash_remitted = 0;
		$discount = 0;
		$balance = 0;


		$taxi_class_ok = true;







		//get rental taxi
		$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "1";
		$row100 = MYSQL_SELECT("select taxi.body_no,billing_taxi.t_current_rent_price,in_out.in_time,in_out.out_time,taxi.tc_id from taxi,billing_taxi,in_out where taxi.t_id=billing_taxi.t_id and in_out.b_id=billing_taxi.b_id and billing_taxi.b_id = " . $_SESSION[$sess_name105 . '_' . $x . '_0'], $sess_name100, 4);



		for ($xx = 0; $xx < $row100; $xx++) {

			if (isset($_SESSION[$sess_name100 . '_' . $xx . '_0'])) {



				if ($taxiclass != "All") {


					$sess_name11010110 = "data100110111_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $xx;
					$row100 = MYSQL_SELECT("select tc_text from taxi_class where tc_id=" . $_SESSION[$sess_name100 . '_' . $xx . '_4'], $sess_name11010110, 0);



					if ($_SESSION[$sess_name11010110 . '_0_0'] != $taxiclass) {
						$taxi_class_ok = false;
					} else {
						$taxi_class_ok = true;
					}
				}



				if ($taxi_class_ok == true) {


					$rental += $_SESSION[$sess_name100 . '_' . $xx . '_1'];
					$rental_overall += $_SESSION[$sess_name100 . '_' . $xx . '_1'];

					$taxi_body_no = $_SESSION[$sess_name100 . '_' . $xx . '_0'];
				}
			}
		}



		if ($_POST['show_no_taxi_rented_cb'] == "No") {


			if ($row100 == 0) {
				$taxi_class_ok = false;
			}
		}





		if ($taxi_class_ok == true) {






			//check if paid
			$sess_name106 = "data106_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "2";
			$row56 = MYSQL_SELECT("select amount_payed,pay_time from billing_payments where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'] . " order by b_pay_id asc", $sess_name106, 1);


			$billing_overall_total = $_SESSION[$sess_name105 . '_' . $x . '_6'] + $_SESSION[$sess_name105 . '_' . $x . '_3'] - $_SESSION[$sess_name105 . '_' . $x . '_5'];


			for ($y = 0; $y < $row56; $y++) {


				$cash_remitted += $_SESSION[$sess_name106 . '_' . $y . '_0'];
				$cash_remitted_overall += $_SESSION[$sess_name106 . '_' . $y . '_0'];
			}










			//get gas
			$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "3";
			$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'] . " order by g_id desc", $sess_name101, 2);

			for ($xxx = 0; $xxx < $row101; $xxx++) {

				if (isset($_SESSION[$sess_name101 . '_' . $xxx . '_0'])) {
					$gas += $_SESSION[$sess_name101 . '_' . $xxx . '_0'] * $_SESSION[$sess_name101 . '_' . $xxx . '_1'];
					$gas_overall += $_SESSION[$sess_name101 . '_' . $xxx . '_0'] * $_SESSION[$sess_name101 . '_' . $xxx . '_1'];
				}
			}



			//get products
			$sess_name107 = "data107_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "4";
			$row107 = MYSQL_SELECT("select p_current_name,p_current_price from billing_products where b_id=" . $_SESSION[$sess_name105 . '_' . $x . '_0'], $sess_name107, 1);

			for ($xxxx = 0; $xxxx < $row107; $xxxx++) {

				if (isset($_SESSION[$sess_name107 . '_' . $xxxx . '_0'])) {
					$others += $_SESSION[$sess_name107 . '_' . $xxxx . '_1'];
					$others_overall += $_SESSION[$sess_name107 . '_' . $xxxx . '_1'];
				}
			}




			if ($_SESSION[$sess_name105 . '_' . $x . '_3'] != 0) {
				$others += $_SESSION[$sess_name105 . '_' . $x . '_3'];
				$others_overall += $_SESSION[$sess_name105 . '_' . $x . '_3'];
			}


			if ($_SESSION[$sess_name105 . '_' . $x . '_5'] != 0) {

				$discount += $_SESSION[$sess_name105 . '_' . $x . '_5'];
				$discount_overall += $_SESSION[$sess_name105 . '_' . $x . '_5'];
			}



			if ($billing_overall_total != $cash_remitted) {

				$balance += $billing_overall_total - $cash_remitted;
				$balance_overall += $billing_overall_total - $cash_remitted;
			}





			if ($rental - $balance < 0) {
				$rental = 0;
			} else {
				$rental -= $balance;
			}






			//get driver name
			$sess_name121 = "data121_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . "4";
			MYSQL_SELECT("select f_name,m_name,l_name from driver where d_id=" . $_SESSION[$sess_name105 . '_' . $x . '_1'], $sess_name121, 2);


			$driver_name = $_SESSION[$sess_name121 . '_0_0'] . " " . $_SESSION[$sess_name121 . '_0_1'] . " " . $_SESSION[$sess_name121 . '_0_2'];




			$fpdf->Cell(53, 7, $driver_name, 1, 0);

			$fpdf->Cell(15, 7, $taxi_body_no, 1, 0);

			$fpdf->Cell(17, 7, number_format($rental, 2), 1, 0);

			$fpdf->Cell(38, 7, number_format($gas, 2), 1, 0);

			$fpdf->Cell(38, 7, number_format($others, 2), 1, 0);

			$fpdf->Cell(38, 7, number_format($discount, 2), 1, 0);

			$fpdf->Cell(38, 7, number_format($cash_remitted, 2), 1, 0);

			$fpdf->Cell(38, 7, number_format($balance, 2), 1, 1);
		}
	}




































	$fpdf->output();
}










function monthly($from, $to, $taxiclass)
{






	include("plugins/FPDF/fpdf.php");

	$fpdf = new FPDF('P', 'mm', 'A4');



	$fpdf->SetTitle("Report");


	//$fpdf->SetMargins(5, 5, 5);


	$fpdf->AddPage("L"); //275






	$fpdf->SetFont("Arial", "", 25);


	$fpdf->Cell(0, 15, "MONTHLY SALES REPORT", 0, 1, "C");






	$fpdf->SetFont("Arial", "", 10);


	$fpdf->Cell(10, 7, "Date:", 0, 0);

	if ($from != $to) {
		$fpdf->Cell(50, 7, DateNumToText($from) . " - " . DateNumToText($to), "B", 0);
	} else {
		$fpdf->Cell(50, 7, DateNumToText($from), "B", 0);
	}


	$fpdf->Cell(245, 10, "", 0, 1);



	$fpdf->Cell(32, 7, "Taxi Classification:", 0, 0);
	$fpdf->Cell(70, 7, "All", "B", 0);
	$fpdf->Cell(173, 10, "", 0, 1);


	// Get Data
	$monthlyData = array();
	$totalRentals = 0;
	$totalGasAmountPaidOrNot = 0;
	$totalGasLitersPaidOrNot = 0;
	$totalGasAmount = 0;
	$totalGasLiters = 0;
	$totalOthers = 0;
	$totalDiscount = 0;
	$totalBalance = 0;
	$overallTotal = 0;
	$totalOtherProducts = 0;
	$totalCarWash = 0;
	$totalSSS = 0;
	$totalCashBond = 0;

	require_once(__DIR__ . "/functions/db.php");
	require_once(__DIR__ . "/functions/getDailyReport.php");

	$begin = new DateTime($from . " 00:00:00");
	$end = new DateTime($to . " 23:59:59");

	// Will loop through datefrom - dateto day by day
	$interval = DateInterval::createFromDateString('1 day');
	$period = new DatePeriod($begin, $interval, $end);

	foreach ($period as $dt) {
		$dailyReport = getDailyReport($dt->format("Y-m-d"), "All");
		$dailyReport["date"] = $dt->format("M d, Y");

		$totalRentals += str_replace(",","",$dailyReport["totalRentalAmount"]);
		$totalGasAmountPaidOrNot += str_replace(",","",$dailyReport["totalGasAmountPaidOrNot"]);
		$totalGasLitersPaidOrNot += str_replace(",","",$dailyReport["totalGasLitersPaidOrNot"]);
		$totalGasAmount += str_replace(",","",$dailyReport["totalGasAmount"]);
		$totalGasLiters += str_replace(",","",$dailyReport["totalGasLiters"]);
		$totalOthers += str_replace(",","",$dailyReport["totalOthersAmount"]);
		$totalDiscount += str_replace(",","",$dailyReport["totalDiscountAmount"]);
		$totalBalance += str_replace(",","",$dailyReport["totalBalance"]);
		$overallTotal += str_replace(",","",$dailyReport["grandTotal"]);
		$totalOtherProducts +=  str_replace(",","",$dailyReport["totalOtherProducts"]);
		$totalCarWash += str_replace(",","",$dailyReport["totalCarWash"]);
		$totalSSS += str_replace(",","",$dailyReport["totalSSSPHICHDMF"]);
		$totalCashBond += str_replace(",","",$dailyReport["totalCashBond"]);

		array_push($monthlyData, $dailyReport);
	}


	$fpdf->Cell(30, 7, "Total Net Rental:", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalRentals,2), "B", 0);


	$fpdf->Cell(18, 7, "Total Gas:", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalGasAmountPaidOrNot,2) . "(".$totalGasLitersPaidOrNot." Liters)", "B", 0);


	$fpdf->Cell(30, 7, "Total Gas (Paid):", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalGasAmount,2) . "(".$totalGasLiters." Liters)", "B", 0);

	$fpdf->Cell(98, 10, "", 0, 1);


	$fpdf->Cell(35, 7, "Total Others:", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalOthers,2), "B", 0);

	$fpdf->Cell(25, 7, "Total Discount:", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalDiscount,2), "B", 0);

	$fpdf->Cell(25, 7, "Total Shortage:", 0, 0);
	$fpdf->Cell(39, 7, number_format($totalBalance,2), "B", 0);

	$fpdf->Cell(73, 10, "", 0, 1);

	$fpdf->Cell(35, 7, "Total Cash Bond:", 0, 0);
	$fpdf->Cell(90, 7, number_format($totalCashBond,2), "B", 0);


	$fpdf->Cell(40, 7, "Total SSS/PHIC/HDMF:", 0, 0);
	$fpdf->Cell(90, 7, number_format($totalSSS,2), "B", 0);


	$fpdf->Cell(73, 10, "", 0, 1);

	$fpdf->Cell(30, 7, "Total Car Wash:", 0, 0);
	$fpdf->Cell(90, 7, number_format($totalCarWash,2), "B", 0);

	$fpdf->Cell(35, 7, "Total Other Products:", 0, 0);
	$fpdf->Cell(90, 7, number_format($totalOtherProducts,2), "B", 0);

	$fpdf->Cell(73, 10, "", 0, 1);

	$fpdf->Cell(23, 7, "Overall Total:", 0, 0);
	$fpdf->Cell(90, 7, number_format($overallTotal,2), "B", 0);

	$fpdf->Cell(162, 30, "", 0, 1);


	$fpdf->SetFont("Arial", "B", 9);

	// Columns

	$fpdf->Cell(22, 7, "Date", 1, 0);

	$fpdf->Cell(25, 7, "Net Rental", 1, 0);

	$fpdf->Cell(38, 7, "Gasoline", 1, 0);

	$fpdf->Cell(38, 7, "Gasoline (Paid)", 1, 0);

	$fpdf->Cell(38, 7, "Other Collections", 1, 0);

	$fpdf->Cell(38, 7, "Discount", 1, 0);

	$fpdf->Cell(38, 7, "Shortage", 1, 0);

	$fpdf->Cell(38, 7, "Total", 1, 1);


	$fpdf->SetFont("Arial", "", 9);

	foreach ($monthlyData as $data) {
		$fpdf->Cell(22, 7, $data["date"], 1, 0);

		$fpdf->Cell(25, 7, $data["totalRentalAmount"], 1, 0);

		$fpdf->Cell(38, 7, $data["totalGasAmountPaidOrNot"] . "(".$data["totalGasLitersPaidOrNot"]." Liters)", 1, 0);

		$fpdf->Cell(38, 7, $data["totalGasAmount"] . "(".$data["totalGasLiters"]." Liters)", 1, 0);

		$fpdf->Cell(38, 7, $data["totalOthersAmount"], 1, 0);

		$fpdf->Cell(38, 7, $data["totalDiscountAmount"], 1, 0);

		$fpdf->Cell(38, 7, $data["totalBalance"], 1, 0);

		$fpdf->Cell(38, 7, $data["grandTotal"], 1, 1);
	}
	$fpdf->output();
}
