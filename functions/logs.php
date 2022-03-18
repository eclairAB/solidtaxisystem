<?php



function log_add($action)
{


	date_default_timezone_set('Asia/Manila');

	$action = str_replace("'", "''", $action);

	MYSQL_INSERT("logs","action,l_time,a_id","'".$action."','".Date("Y-m-d H:i:s")."',".$_SESSION['login_details_0_0']);

}





?>