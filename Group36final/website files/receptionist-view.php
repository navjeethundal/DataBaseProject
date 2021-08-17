<?php
ob_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">
<html>
<body>
<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


$StaffNo = $_POST["StaffNo"];
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$Email = $_POST["Email"];
$Password = $_POST["Password"];
$HourlyWage = $_POST["HourlyWage"];


if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Staff VALUES (?,?,?,?,?)");
	$statement->bind_param("issss", $StaffNo, $Fname, $Lname, $Email, $Password);
	$statement->execute();
	
	$statement2 = $con->prepare("INSERT INTO Receptionist VALUES (?,?)");
	$statement2->bind_param("ii", $StaffNo, $HourlyWage);
	$statement2->execute();
	echo "New Receptionist member added!<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Staff SET Fname = ?, Lname = ?, Email = ?, Password = ? WHERE StaffNo = ?");
	$statement->bind_param("ssssi", $Fname, $Lname, $Email, $Password, $StaffNo);
	$statement->execute();
	
	$statement = $con->prepare("UPDATE Receptionist SET HourlyWage = ? WHERE StaffNo = ?");
	$statement->bind_param("ii", $HourlyWage, $StaffNo);
	$statement->execute();
	echo "Receptionist member updated!<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$StaffNo = $_GET["StaffNo"];
	
	$statement = $con->prepare("DELETE FROM Receptionist WHERE StaffNo = ?");
	$statement->bind_param("i", $StaffNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~1 No rows updated ~<br><br>');  // check for errors with the operation
	
	$statement = $con->prepare("DELETE FROM Staff WHERE StaffNo = ?");
	$statement->bind_param("i", $StaffNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~2 No rows updated ~<br><br>');  // check for errors with the operation

	echo "Receptionist member removed from database!<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Receptionist, Staff WHERE Staff.StaffNo = Receptionist.StaffNo");
echo "Here's all our Receptionist: <br><br>
<table border='1'>
<tr>
<th>Staff Number</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Hourly Wage</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "<td>" . $row['Fname'] . "</td>";
	echo "<td>" . $row['Lname'] . "</td>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td>" . $row['HourlyWage'] . "</td>";
	echo "<td><a href='receptionist-update.php?StaffNo=" . $row['StaffNo'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this receptionist member?')\" href='receptionist-view.php?job=delete&amp;StaffNo= " . $row['StaffNo'] . "'>DELETE</a></td>";
	echo "</tr>";
	
}
echo "</table><br><br><a href=\"receptionist-add.php\">Add a new receptionist member</a>";




mysqli_close($con); 

?>
	<form action = "staff-home.php">
       	<input type = "submit" value = "Go Back">
    </form>
</body>
</html>
