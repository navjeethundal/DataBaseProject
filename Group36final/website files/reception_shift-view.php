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
$Day = $_POST["Day"];
$Time = $_POST["Time"];
$PreviousDay = $_POST["PreviousDay"];
$PreviousTime = $_POST["PreviousTime"];
$ReceptionistNo = $_POST["ReceptionistNo"];


if ($_GET["job"] == "add")
{	
	$statement = $con->prepare("INSERT INTO Reception_Shift VALUES (?,?,?)");
	$statement->bind_param("ssi", $Day, $Time, $ReceptionistNo);
	$statement->execute();
	echo "New Reception Shift added<br><br><br>";
} 


if ($_GET["job"] == "update")
{	
	echo "update values:  Day: " . $Day . " &nbsp; Time: " . $Time . " &nbsp; Previous Day: " . $PreviousDay . " &nbsp; Previous Time: " . $PreviousTime . " &nbsp; ReceptionistNo: " . $ReceptionistNo . "<br><br>";
	$statement = $con->prepare("UPDATE Reception_Shift SET Day = ?, Time = ?, ReceptionistNo = ? WHERE Day = ? AND Time = ? AND ReceptionistNo = ?;");
	$statement->bind_param("ssissi", $Day, $Time, $ReceptionistNo, $PreviousDay, $PreviousTime, $ReceptionistNo);
	$statement->execute();
	echo "Reception Shift updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$ReceptionistNo = $_GET["ReceptionistNo"];
	$Day = $_GET["Day"];
	$Time = $_GET["Time"];
	
	$statement = $con->prepare("DELETE FROM Reception_Shift WHERE Day = ? AND Time = ? AND ReceptionistNo = ?");
	$statement->bind_param("ssi", $Day, $Time, $ReceptionistNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Reception Shift removed<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Receptionist, Staff, Reception_Shift WHERE Staff.StaffNo = Receptionist.StaffNo AND Reception_Shift.ReceptionistNo = Staff.StaffNo");
echo "Receptionist Shifts: <br><br>
<table border='1'>
<tr>
<th>Receptionist</th>
<th>Shift Day</th>
<th>Shift Time</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['Fname'] . " " . $row['Lname'] . "</td>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>";?>
				 <form action="reception_shift-update.php" method="post">
				   <input name="ReceptionistNo" type="hidden" value=<?php echo $row['ReceptionistNo'];?>>
				   <input name="Day" type="hidden" value='<?php echo $row['Day'];?>'>
				   <input name="Time" type="hidden" value='<?php echo $row['Time'];?>'>
				   <input type="submit" value="Update">
				</form></td>
	<?php
	echo "<td><a onClick= \"return confirm('Do you want to delete this reception shift?')\" href='reception_shift-view.php?job=delete&amp;ReceptionistNo=" . $row['ReceptionistNo'] . "&amp;Day=" . $row['Day'] . "&amp;Time=" . $row['Time'] . "'>DELETE</a></td>";
	echo "</tr>";
	
}
echo "</table><br><br><a href=\"reception_shift-add.php\">Add a new reception shift</a>";




mysqli_close($con); 

?>

<br><br>
<form action = "staff-home.php">
   	<input type = "submit" value = "Go Back">
</form>

</div>
<div style="position: absolute; right: 0px; top: 10px; width: 200px; height: 50px;">Logout button could go here</div>

</body>
</html>
