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


$Day = $_POST["Day"];
$Atime = $_POST["Time"];
$TherapistNo = $_POST["TherapistNo"];
$ServiceNo = $_POST["ServiceNo"];
$ClientEmail = $_POST["ClientEmail"];
$ApproveStaffNo = $_POST["ApproveStaffNo"];
$Notes = $_POST["Notes"];


if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Appointment VALUES (?,?,?,?,?,?,?)");
	$statement->bind_param("ssiisis", $Day, $Time, $TherapistNo, $ServiceNo, $ClientEmail, $ApproveStaffNo, $Notes);
	$statement->execute();
	
	echo "New appointment added!<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Appointment SET ClientEmail = ?, Day = ?, Atime = ?, TransactionNo = ? , ServiceNo = ?, ApproveStaffNo = ?, Notes = ? WHERE ClientEmail = ?");
	$statement->bind_param("sssiiiss", $ClientEmail, $Day, $Atime, $TransactionNo, $ServiceNo, $ApproveStaffNo, $Notes, $ClientEmail);
	$statement->execute();
	
	echo "Appointment updated!<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$ClientEmail = $_GET["ClientEmail"];
	
	$statement = $con->prepare("DELETE FROM Appointment WHERE ClientEmail = ?");
	$statement->bind_param("s", $ClientEmail);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~1 No rows updated ~<br><br>');  // check for errors with the operation
	

	echo "Appointment removed from database!<br><br><br>";
}



//$result = mysqli_query($con, "SELECT * FROM Appointment, Therapist, Service, Client, Staff WHERE Appointment.TherapistNo = Therapist.StaffNo AND Appointment.ServiceNo = Service.ServiceNo AND Appointment.ClientEmail = Client.Email AND Appointment.ApproveStaffNo = Staff.StaffNo");
$result = mysqli_query($con, "SELECT * FROM Appointment");

echo "Here's all appointments: <br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>Therapist Number</th>
<th>Service Number</th>
<th>Client Email</th>
<th>Appproved Staff Number</th>
<th>Notes</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "<td>" . $row['ApproveStaffNo'] . "</td>";
	echo "<td>" . $row['Notes'] . "</td>";
	echo "<td><a href='appointment-update.php?ClientEmail=" . $row['ClientEmail'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this sale?')\" href='appointment-view.php?job=delete&amp;ClientEmail= " . $row['ClientEmail'] . "'>DELETE</a></td>";
	echo "</tr>";
	
}
echo "</table><br><br><a href=\"make-appointment1.php\">Add a new appointment</a>";


mysqli_close($con); 

?>
	<form action = "staff-home.php">
        <input type = "submit" value = "Go Back">
    </form>
</body>
</html>
