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

(for debugging purposes:) &nbsp;<a href="https://www.iwanttowalkagain.com/user471/view-staff.php">RELOAD PAGE</a><br><br><br>
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


if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Staff VALUES (?,?,?,?,?)");
	$statement->bind_param("issss", $StaffNo, $Fname, $Lname, $Email, $Password);
	$statement->execute();
	echo "New staff member added<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Staff SET Fname = ?, Lname = ?, Email = ?, Password = ? WHERE StaffNo = ?");
	$statement->bind_param("ssssi", $Fname, $Lname, $Email, $Password, $StaffNo);
	$statement->execute();
	echo "Staff member updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$StaffNo = $_GET["StaffNo"];
	$statement = $con->prepare("DELETE FROM Staff WHERE StaffNo = ?");
	$statement->bind_param("i", $StaffNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Staff member removed from database<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Staff");

echo "Staff members:<br><br>
<table border='1'>
<tr>
<th>Staff Number</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "<td>" . $row['Fname'] . "</td>";
	echo "<td>" . $row['Lname'] . "</td>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td><a href='update-staff.php?StaffNo=" . $row['StaffNo'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this staff member?')\" href='view-staff.php?job=delete&amp;StaffNo= " . $row['StaffNo'] . "'>DELETE</a></td>";

	echo "</tr>";
}
echo "</table><br><br><a href=\"add-staff.php\">Add a new staff member</a>";







mysqli_close($con); 

?>
	<form action = "staff-home.php">
    	<input type = "submit" value = "Go Back">
    </form>

</div>
</body>
</html>





























