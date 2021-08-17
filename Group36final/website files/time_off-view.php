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

<?php
session_start();


// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

$StaffNo = $_POST["StaffNo"];
$Day = $_POST["Day"];
$Time = $_POST["Time"];
$sessionUser = $_SESSION['user'];


if ($_GET["job"] == "add")
{
	//Check if StaffNo exists!!!@!@?!>@!@> in staff
	$results =  mysqli_query($con, 'SELECT 1 FROM Staff WHERE Staff.StaffNo="'.$StaffNo.'"');
	
	if (!(mysqli_num_rows($results) == 0)){
		$statement = $con->prepare("INSERT INTO Time_Off VALUES (?,?,?)");
		$statement->bind_param("ssi", $Day, $Time, $StaffNo);
		$statement->execute();
		echo "New Time-Off added<br><br><br>";
	} else 
		echo "Staff doesn't exist, no Time-Off added";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Time_Off SET Day = ?, Time = ? WHERE StaffNo = ?");
	$statement->bind_param("ssi", $Day, $Time, $StaffNo);
	$statement->execute();
	echo "Staff Time-Off updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$StaffNo = $_GET["StaffNo"];
	$Day = $_GET["Day"];
	$Time = $_GET["Time"];
	$statement = $con->prepare("DELETE FROM Time_Off WHERE StaffNo = ? AND Day = ? AND Time = ?");
	$statement->bind_param("iss", $StaffNo, $Day, $Time);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Staff Time-Off removed from database<br><br><br>";
}

//Set StaffNo to current Session user
//Get related StaffNo based on Session 'user'
$statement = $con->prepare("SELECT * FROM Staff WHERE Staff.Email=?");
$statement->bind_param("s", $_SESSION['user']);
$statement->execute();
$statement->store_result();
if ($statement->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check
$statement->bind_result($xStaffNo, $xFname, $xLname, $xEmail, $xPassword);
while($statement->fetch()){
	$StaffNo = $xStaffNo;
}

echo "Current User(Session): ". $_SESSION['user'] . "<br>";
echo "Current User Number(Session): ". $StaffNo . "<br><br>";

//Check access
$statement = $con->prepare("SELECT * FROM Receptionist WHERE Receptionist.StaffNo=?");
$statement->bind_param("i", $StaffNo);
$statement->execute();
$statement->store_result();
if ( (!($statement->num_rows === 0)) or $StaffNo < 10){
		
	//IF RECEPTIONLIST OR STAFFNO < 10
	$result = mysqli_query($con, "SELECT * FROM Staff, Time_Off WHERE Staff.StaffNo = Time_Off.StaffNo");
	echo "All Time_Offs:<br>
	<table border='1'>
	<tr>
	<th>Staff Number</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Day</th>
	<th>Time</th>
	<th>update?</th>
	<th>delete?</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['StaffNo'] . "</td>";
		echo "<td>" . $row['Fname'] . "</td>";
		echo "<td>" . $row['Lname'] . "</td>";
		echo "<td>" . $row['Day'] . "</td>";
		echo "<td>" . $row['Time'] . "</td>";
		echo "<td><a href='time_off-update.php?StaffNo=" . $row['StaffNo'] . "' >Update</a></td>";
		echo "<td><a onClick= \"return confirm('Do you want to delete this Time-Off?')\"   href='time_off-view.php?job=delete&amp;StaffNo= " .$row['StaffNo']. "&amp;Day=".$row['Day']." &amp;Time=".$row['Time']."  '>DELETE</a></td>";
		echo "</tr>";
	}
	echo "</table><br><br><a href=\"time_off-add.php\">Add a new Time-Off</a>";
	
	
	
} else {
	
	
	//LIMITED ACCESS
	//NOT RECEPTIONLIST OR STAFFNO < 10
	$result = mysqli_query($con, "SELECT * FROM Staff, Time_Off WHERE Staff.StaffNo = Time_Off.StaffNo");
	echo "All Time_Offs(NOT CURRENT USER) :<br>
	<table border='1'>
	<tr>
	<th>Staff Number</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Day</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['StaffNo'] . "</td>";
		echo "<td>" . $row['Fname'] . "</td>";
		echo "<td>" . $row['Lname'] . "</td>";
		echo "<td>" . $row['Day'] . "</td>";
		echo "<td>" . $row['Time'] . "</td>";
		echo "</tr>";
	}
	
	
	//ONLY CURRENT STAFF 
	$result = mysqli_query($con, "SELECT * FROM Staff, Time_Off WHERE Staff.StaffNo = Time_Off.StaffNo AND Time_Off.StaffNo=".$StaffNo);
	echo "<br><br>Current User Time_Offs:<br>
	
	<table border='1'>
	<tr>
	<th>Staff Number</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Day</th>
	<th>Time</th>
	<th>update?</th>
	<th>delete?</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['StaffNo'] . "</td>";
		echo "<td>" . $row['Fname'] . "</td>";
		echo "<td>" . $row['Lname'] . "</td>";
		echo "<td>" . $row['Day'] . "</td>";
		echo "<td>" . $row['Time'] . "</td>";
		echo "<td><a href='time_off-update.php?StaffNo=" . $row['StaffNo'] . "' >Update</a></td>";
		echo "<td><a onClick= \"return confirm('Do you want to delete this Time-Off?')\" href='time_off-view.php?job=delete&amp;StaffNo= " . $row['StaffNo'] . "'>DELETE</a></td>";
		echo "</tr>";
	}
	echo "</table><br><br><a href='time_off-add2.php?StaffNo=" . $StaffNo. "' >Add a new Time-Off</a>";
}




mysqli_close($con); 
?>

	<form action = "staff-home.php">
    	<input type = "submit" value = "Go Back">
    </form>

</div>
</body>
</html>