<?php
ob_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>

<html>
<head>
<body>
<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">

<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


$TherapistNo = $_POST["TherapistNo"];
$ServiceNo = $_POST["ServiceNo"];
$Day = $_POST["Day"];
$Time = $_POST["Time"];
$ClientEmail = $_POST["ClientEmail"];
$Phone_Num = $_POST["Phone_Num"];
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$Notes = $_POST["Notes"];



if ($_GET["job"] == "add")
{	
	// add a new Client
	$statement = $con->prepare("INSERT INTO Client VALUES (?,?,?,?)");
	$statement->bind_param("ssss", $ClientEmail, $Phone_Num, $Fname, $Lname);
	$statement->execute();

	// add the Appointment
	$statement = $con->prepare("INSERT INTO Appointment VALUES (?,?,?,?,?,-1,?)");
	$statement->bind_param("ssiiss", $Day, $Time, $TherapistNo, $ServiceNo, $ClientEmail, $Notes);
	$statement->execute();

	echo "Thank you " . $Fname . " " . $Lname . "<br>Your appointment has been requested. We will be in touch soon.<br><br><br>";
} 





$result = mysqli_query($con, "SELECT * FROM Service");
echo "What type of appointment would you like to book?<br><br>
<table border='1'>
<tr>
<th>Click on the service you are interested in...</th>
</tr>";

while ($row = mysqli_fetch_array($result)){ 
	echo "<tr><td><a href='make-appointment2.php?ServiceNo=" . $row['ServiceNo'] . "'>" . $row['ServiceName'] . "</a></td></tr>";
}
echo "</table>";




mysqli_close($con); 

?>

<br><br>
<form action = "index.php">
   	<input type = "submit" value = "Go Back">
</form>

</div>


</body>
</html>
