<?php


function getDailyReport($date, $taxiClassification)
{

    $totalGasLiters = 0;
    $totalGasAmount = 0;
    $totalRentalAmount = 0;
    $totalCashBond = 0;
    $totalSSSPHICHDMF = 0;
    $totalCarWash = 0;
    $totalOthersAmount = 0;
    $totalDiscountAmount = 0;
    $grandTotal = 0;
    $totalGasAmountPaidOrNot = 0;
    $totalGasLitersPaidOrNot = 0;
    $totalBalance = 0;
    $totalOtherProducts = 0;

    $billings = getBilling($date, $taxiClassification);

    foreach ($billings as $billing) {
        $rentalAmount = getTotalRentalAmount($billing["b_id"]);

        // Rental minus discount
        $rentalAmount -= $billing["discountAmount"];

        $products = getProducts($billing["b_id"]);

        $gas = getTotalGas($billing["b_id"]);
        $totalPayments = getTotalPayments($billing["b_id"], $date);

        $totalPayments["totalAmountPayed"] = isset($totalPayments["totalAmountPayed"]) ? $totalPayments["totalAmountPayed"] : 0;
        $totalPayments["totalAmountPayedByDate"] = isset($totalPayments["totalAmountPayedByDate"]) ? $totalPayments["totalAmountPayedByDate"] : 0;

        $totalAmountPayedWithoutSelectedDate = $totalPayments["totalAmountPayed"] - $totalPayments["totalAmountPayedByDate"];
        $totalAmountPayedSelectedDate = isset($totalPayments["totalAmountPayedByDate"]) ? $totalPayments["totalAmountPayedByDate"] : 0;

        // Prioritiy
        // Gas
        if (isset($gas["totalGasAmount"])) {

            // Add paid / not paid total gas and liters only if billing date is selected date
            if ($billing["billingDate"] == $date) {
                $totalGasAmountPaidOrNot += $gas["totalGasAmount"];
                $totalGasLitersPaidOrNot += $gas["totalGasLiters"];
            }

            $result = payCompute($gas["totalGasAmount"], $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            if ($result["usedAmount"] != 0) {
                $totalGasAmount += $result["usedAmount"];
                $totalGasLiters += number_format($gas["totalGasLiters"] * ($result["usedAmount"] / $gas["totalGasAmount"]), 2);
            }

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        // Prioritiy
        // Cash Bond
        if (isset($products["totalCashBond"])) {

            $result = payCompute($products["totalCashBond"], $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            $totalCashBond += $result["usedAmount"];

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        // Prioritiy
        // SSS / HDMF / PHIC
        if (isset($products["totalSSSPHICHDMF"])) {

            $result = payCompute($products["totalSSSPHICHDMF"], $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            $totalSSSPHICHDMF += $result["usedAmount"];

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        // Prioritiy
        // Car Wash
        if (isset($products["totalCarWash"])) {

            $result = payCompute($products["totalCarWash"], $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            $totalCarWash += $result["usedAmount"];

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        // Prioritiy
        // Other Products
        if (isset($products["totalProductsAmount"])) {

            $otherProductsAmount = $products["totalProductsAmount"] - $products["totalCashBond"] - $products["totalCarWash"] - $products["totalSSSPHICHDMF"];

            if ($otherProductsAmount > 0) {

                $result = payCompute($otherProductsAmount, $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

                $totalOtherProducts += $result["usedAmount"];

                if ($result["amountToPayLeft"] > 0) {
                    if ($billing["billingDate"] == $date) {
                        $totalBalance += $result["amountToPayLeft"];
                    }
                }

                // Update
                $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
                $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
            }
        }

        // Prioritiy
        // Others
        if (isset($billing["othersAmount"])) {

            $result = payCompute($billing["othersAmount"], $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            $totalOthersAmount += $result["usedAmount"];

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        // Prioritiy
        // Rental
        if ($rentalAmount != 0) {

            $result = payCompute($rentalAmount, $totalAmountPayedWithoutSelectedDate, $totalAmountPayedSelectedDate);

            $totalRentalAmount += $result["usedAmount"];

            if ($result["amountToPayLeft"] > 0) {
                if ($billing["billingDate"] == $date) {
                    $totalBalance += $result["amountToPayLeft"];
                }
            }

            // Update
            $totalAmountPayedWithoutSelectedDate = $result["amountWithoutSelectedDateLeft"];
            $totalAmountPayedSelectedDate = $result["amountSelectedDateLeft"];
        }

        if ($billing["billingDate"] == $date) {
            $totalDiscountAmount += $billing["discountAmount"];
        }
    }

    // Sum grand total, cash on hand of cashier
    $grandTotal = $totalGasAmount
        + $totalRentalAmount
        + $totalCashBond
        + $totalSSSPHICHDMF
        + $totalCarWash
        + $totalOthersAmount
        + $totalOtherProducts;

    $finalData = array(
        "totalGasLiters" => $totalGasLiters,
        "totalGasAmount" => number_format($totalGasAmount, 2),
        "totalRentalAmount" => number_format($totalRentalAmount, 2),
        "totalCashBond" => number_format($totalCashBond, 2),
        "totalSSSPHICHDMF" => number_format($totalSSSPHICHDMF, 2),
        "totalCarWash" => number_format($totalCarWash, 2),
        "totalOthersAmount" => number_format($totalOthersAmount, 2),
        "totalDiscountAmount" => number_format($totalDiscountAmount, 2),
        "totalGasAmountPaidOrNot" => number_format($totalGasAmountPaidOrNot, 2),
        "totalGasLitersPaidOrNot" => $totalGasLitersPaidOrNot,
        "totalBalance" => number_format($totalBalance, 2),
        "currentGasPrice" => number_format(getCurrentGasPrice(), 2),
        "totalOtherProducts" => number_format($totalOtherProducts, 2),
        "grandTotal" => number_format($grandTotal, 2)
    );

    return $finalData;
}

function payCompute($amountToPay, $amountWithoutSelectedDate, $amountSelectedDate)
{

    $dummyAmount = $amountToPay;
    $dummyAmountSelectedDate = $amountSelectedDate;
    $usedAmount = 0;

    if ($amountWithoutSelectedDate > 0) {

        // Minus amount to pay using amount without selected date
        $dummyAmount -= $amountWithoutSelectedDate;

        // Update amount without selected date
        $amountWithoutSelectedDate -= $amountToPay;
    }

    if ($dummyAmount > 0) {

        if ($amountSelectedDate > 0) {

            $currentDummyAmount = $dummyAmount;

            // Minus amount to pay using amount selected date
            $dummyAmount -= $amountSelectedDate;

            // Update amount selected date
            $amountSelectedDate -= $currentDummyAmount;

            // If we use all our amount selected date
            if ($amountSelectedDate < 1) {
                $usedAmount = $dummyAmountSelectedDate;
            }

            // If we have left means we only use the amount to pay
            else {
                $usedAmount = $amountToPay;
            }
        }
    }

    return array(
        "amountToPayLeft" => $dummyAmount,
        "amountWithoutSelectedDateLeft" => $amountWithoutSelectedDate,
        "amountSelectedDateLeft" => $amountSelectedDate,
        "usedAmount" => $usedAmount
    );
}

function getBilling($date, $taxiClassification)
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    // Needs 1 billing = 1 taxi rent to filter by taxi classification
    // $taxiClassificationClause = "";
    // if($taxiClassification != "All") {
    //   $taxiClassificationClause = "and tc.tc_text = '".$taxiClassification."'";
    // }
    // $query = "
    //             SELECT 
    //             billing.b_id,
    //             DATE_FORMAT(billing.b_time, '%Y-%m-%d') as billingDate,
    //             overall_total,
    //             IF(billing.b_time between '" . $date . " 00:00:00' and '" . $date . " 23:59:59',billing.discount_amount,0) as discountAmount,
    //             IF(billing.b_time between '" . $date . " 00:00:00' and '" . $date . " 23:59:59',billing.others_amount,0) as othersAmount
    //             from billing, billing_taxi, taxi, taxi_class
    //             where billing.b_id=billing_taxi.b_id
    //             and billing_taxi.t_id=taxi.t_id
    //             and taxi.tc_id = taxi_class.tc_id
    //             ". $taxiClassificationClause;

    $query = "
    SELECT 
                 b_id,
                 DATE_FORMAT(billing.b_time, '%Y-%m-%d') as billingDate,
                 overall_total,
                 discount_amount as discountAmount,
                 others_amount as othersAmount
                from billing
    ";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    return $selectQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getCurrentGasPrice()
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    $query = "select gp_price from gas_price limit 1";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    return $selectQuery->fetch(PDO::FETCH_ASSOC)["gp_price"];
}

function getTotalRentalAmount($billingId)
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    $query = "select sum(t_current_rent_price) as totalRentalAmount from billing_taxi where b_id=" . $billingId . " group by b_id";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    $result = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($result == null) {
        return 0;
    }

    return $result["totalRentalAmount"];
}

function getProducts($billingId)
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    $query = "select 
    sum(IF(p_current_name like '%Cash Bond%', p_current_price, 0)) as totalCashBond, 
    sum(IF(p_current_name like '%SSS%' 
    or p_current_name like '%HDMF%' or p_current_name like '%PHIC%' or p_current_name like '%Philhealth%' or p_current_name like '%Pagibig%', p_current_price, 0)) as totalSSSPHICHDMF,
    sum(IF(p_current_name like '%Car Wash%', p_current_price, 0)) as totalCarWash,
    sum(p_current_price) as totalProductsAmount
    from billing_products where b_id=" . $billingId . " group by b_id";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    return $selectQuery->fetch(PDO::FETCH_ASSOC);
}

function getTotalGas($billingId)
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    $query = "select sum(gas_amount) as totalGasLiters, 
    sum(gas_amount * current_gas_price) as totalGasAmount
    from gas where b_id=" . $billingId . " group by b_id";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    return $selectQuery->fetch(PDO::FETCH_ASSOC);
}

function getTotalPayments($billingId, $date)
{
    require_once(__DIR__ . "/../functions/db.php");
    $DB = DB();

    $query = "select 
    sum(amount_payed) as totalAmountPayed ,
    sum(IF(pay_time between '" . $date . " 00:00:00' and '" . $date . " 23:59:59', amount_payed,0)) as totalAmountPayedByDate
    from billing_payments where b_id=" . $billingId . " group by b_id";

    $selectQuery = $DB->prepare($query);
    $selectQuery->execute();

    return $selectQuery->fetch(PDO::FETCH_ASSOC);
}
