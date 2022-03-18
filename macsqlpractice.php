<html>
<head>
<title></title>	

<style>
table, th, td {
  border: 1px solid blue;
}
</style>
</head>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ac_id, ac_text FROM account_class";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  	echo "<table><tr><th>Account ID</th><th>Account Class</th></tr>";
  
  while($row = $result->fetch_assoc()) {
  	echo "<tr><td>" . $row["ac_id"]. "</td><td>" . $row["ac_text"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>


</body>

</html>