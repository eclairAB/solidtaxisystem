<script type="text/javascript">
	
	$(function () {
  					$('[data-toggle="tooltip"]').tooltip()
				})
</script>


<?php




function PRINT_NAV()
		{
			echo "

	<br>
  <center>
  <div class='container'>

  <button class='btn btn-warning btn-lg' onclick='window.location.href=\"admin.php\"' data-toggle='tooltip' data-placement='top' title=\"Main Dashboard\">Home</button>

  <button class='btn btn-primary btn-lg' onclick='window.location.href=\"accounts.php\"' data-toggle='tooltip' data-placement='top' title=\"User Accounts\">Accounts</button>

  <div class='btn-group' data-toggle='tooltip' data-placement='top' title=\"Drivers Menu\">
    <button type='button' class='btn btn-primary dropdown-toggle btn-lg' data-toggle='dropdown'>
    Driver <span class='caret'></span></button>
    <ul class='dropdown-menu' role='menu'>
      <li><a href='driver.php'>Driver List</a></li>
      <li><a href='driverclassification.php'>Driver Classifications</a></li>
      <li><a href='driver_stats.php'>Driver Statistics</a></li>
    </ul>
  </div>

  <div class='btn-group' data-toggle='tooltip' data-placement='top' title=\"Taxi Menu\">
    <button type='button' class='btn btn-primary dropdown-toggle btn-lg' data-toggle='dropdown'>
    Taxi <span class='caret'></span></button>
    <ul class='dropdown-menu' role='menu'>
      <li><a href='taxi.php'>Taxi List</a></li>
      <li><a href='taxiclassification.php'>Taxi Classifications</a></li>
    </ul>
  </div>

  <div class='btn-group' data-toggle='tooltip' data-placement='top' title=\"Gas Menu\">
    <button type='button' class='btn btn-primary dropdown-toggle btn-lg' data-toggle='dropdown'>
    Gas <span class='caret'></span></button>
    <ul class='dropdown-menu' role='menu'>
      <li><a href='gasprice.php'>Gas Price</a></li>
      <li><a href='gas_inventory.php'>Gas Tank</a></li>
      <li><a href='gasmonreport.php'>Daily Gas Reading</a></li>
    </ul>
  </div>

  	<button class='btn btn-primary btn-lg' onclick='window.location.href=\"products.php\"' data-toggle='tooltip' data-placement='top' title=\"Products List\">Products</button>

  	<button class='btn btn-primary btn-lg' onclick='window.location.href=\"maintenance.php\"' data-toggle='tooltip' data-placement='top' title=\"Taxi Maintenance List\">Maintenance</button>

  	<button class='btn btn-primary btn-lg' onclick='window.location.href=\"report.php\"' data-toggle='tooltip' data-placement='top' title=\"Generate Report\">Report</button>

  	<button class='btn btn-primary btn-lg' onclick='window.location.href=\"logs.php\"' data-toggle='tooltip' data-placement='top' title=\"System Logs\">Logs</button>




</div>
</center>

<hr>";
}


?>
