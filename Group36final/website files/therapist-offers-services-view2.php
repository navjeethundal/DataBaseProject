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

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


$StaffNo = $_GET["StaffNo"];



// --- Staff SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Staff WHERE StaffNo = ?");
$statement->bind_param("i", $StaffNo);
$statement->execute();
$statement->store_result();
//if ($statement->num_rows === 0) exit('Your SELECT query didn\'t return anything(1). Exiting the script...'); // error check

$statement->bind_result($xStaffNo, $xFname, $xLname, $xEmail, $xPassword);

while($statement->fetch()) { 
  $Fname = $xFname;
  $Lname = $xLname;
}

// --- Offers SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Offers WHERE TherapistNo = ?");
$statement->bind_param("i", $StaffNo);
$statement->execute();
$statement->store_result();

$statement->bind_result($xTherapistNo, $xServiceNo, $xPrice, $xDuration);

while($statement->fetch()) { 
  $ServiceNo = $xServiceNo;
  $Price = $xPrice;
  $Duration = $xDuration;
}

// --- Service SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Service WHERE ServiceNo = ?");
$statement->bind_param("i", $ServiceNo);
$statement->execute();
$statement->store_result();

$statement->bind_result($xServiceNo, $xServiceName);

while($statement->fetch()) { 
  $ServiceName = $xServiceName;
}
// ------ / SELECT --------------------------------------------------------



$result = mysqli_query($con, "SELECT * FROM Staff, Service, Offers WHERE Staff.StaffNo = " . $StaffNo . " AND Staff.StaffNo = Offers.TherapistNo AND Offers.ServiceNo = Service.ServiceNo");

echo "Services offered by " . $Fname . " " . $Lname . ": <br><br>
<table border='1'>
<tr>
<th>Service</th>
<th>Duration</th>
<th>Price</th>
<th>Update?</th>
<th>Delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['ServiceName'] . "</td>";
	echo "<td>" . $row['Duration'] . " min</td>";
	echo "<td>$" . $row['Price'] . "</td>";
	echo "<td><a href='therapist-offers-services-update.php?TherapistNo=" . $row['StaffNo'] . "&amp;ServiceNo=" . $row['ServiceNo'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this service?')\" href='therapist-offers-services-view.php?job=delete&amp;TherapistNo=" . $row['StaffNo'] . "&amp;ServiceNo=" . $row['ServiceNo'] . "'>Delete</a></td>";
	echo "</tr>";
}
echo "</table><br><br><a href=\"therapist-offers-services-add.php?TherapistNo=" . $StaffNo . "\">Add a new service for " . $Fname . " " . $Lname . "</a>";




mysqli_close($con); 

?>

<br><br>
<form action = "index.php">
   	<input type = "submit" value = "Go Back">
</form>

</div>


</body>
</html>
