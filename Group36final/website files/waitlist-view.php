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

$Day = $_POST["Day"];
$Time = $_POST["Time"];
$TherapistNo = $_POST["TherapistNo"];
$ServiceNo = $_POST["ServiceNo"];
$ClientEmail = $_POST["ClientEmail"];





if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO WaitList_Request VALUES (?,?,?,?,?)");
	$statement->bind_param("ssiis", $Day, $Time, $TherapistNo, $ServiceNo, $ClientEmail);
	$statement->execute();
	echo "New Waitilst added<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE WaitList_Request 
									SET Day = ?, Time = ?, TherapistNo = ?, ServiceNo = ?, ClientEmail = ? 
									WHERE ClientEmail = ?;
									");
	$statement->bind_param("ssiiss", $Day, $Time, $TherapistNo, $ServiceNo, $ClientEmail, $ClientEmail);
	$statement->execute();
	echo "Client Waitlist updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$Day = $_GET["Day"];
	$Time = $_GET["Time"];
	$statement = $con->prepare("DELETE FROM WaitList_Request WHERE Day = ? AND Time = ?");
	$statement->bind_param("ss", $Day, $Time);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Staff Time-Off removed from database<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM WaitList_Request");
echo "Waitlists:<br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>Therapist No.</th>
<th>Service No.</th>
<th>Email</th>
<th>update?</th>
<th>delete?</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "<td><a href='waitlist-update.php?ClientEmail=" . $row['ClientEmail'] . "' >Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this Waitlist?')\"   href='waitlist-view.php?job=delete&amp;Day=".$row['Day']." &amp;Time=".$row['Time']."  '>DELETE</a></td>";
	echo "</tr>";
}
echo "</table><br><br><a href=\"waitlist-add.php\">Add a new WaitList</a>";








/* NOTE: PROBABLY USE THIS IN THE FUTURE (limit access for client?)
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
		echo "<td><a onClick= \"return confirm('Do you want to delete this Time-Off?')\"   href='time_off-view.php?job=delete&amp;Day=".$row['Day']." &amp;Time=".$row['Time']."  '>DELETE</a></td>";
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
*/


mysqli_close($con); 
?>

	<form action = "staff-home.php">
    	<input type = "submit" value = "Go Back">
    </form>

</div>
</body>
</html>