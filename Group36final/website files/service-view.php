<?php
ob_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<html>
<body>
<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">


(for debugging purposes:) &nbsp;<a href="https://www.iwanttowalkagain.com/user471/service-view.php">RELOAD PAGE</a><br><br><br>
<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

$ServiceNo = $_POST["ServiceNo"];
$ServiceName = $_POST["ServiceName"];



if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Service VALUES (?,?)");
	$statement->bind_param("is", $ServiceNo, $ServiceName);
	$statement->execute();
	echo "New service added<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Service SET ServiceName = ? WHERE ServiceNo = ?");
	$statement->bind_param("si", $ServiceName, $ServiceNo);
	$statement->execute();
	echo "Service updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$StaffNo = $_GET["ServiceNo"];
	$statement = $con->prepare("DELETE FROM Service WHERE ServiceNo = ?");
	$statement->bind_param("i", $ServiceNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Service removed from database<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Service");

echo "Services Offered:<br><br>
<table border='1'>
<tr>
<th>Service Name</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['ServiceName'] . "</td>";
	echo "<td><a href='service-update.php?ServiceNo=" . $row['ServiceNo'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this service?')\" href='service-view.php?job=delete&amp;ServiceNo= " . $row['ServiceNo'] . "'>DELETE</a></td>";

	echo "</tr>";
}
echo "</table><br><br><a href=\"service-add.php\">Add a new service</a>";






mysqli_close($con); 

?>
	<form action = "staff-home.php">
        <input type = "submit" value = "Go Back">
    </form>

</div>
</body>
</html>





























