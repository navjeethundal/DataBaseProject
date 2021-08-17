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


$StaffNo = $_POST["StaffNo"];
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$Email = $_POST["Email"];
$Password = $_POST["Password"];

$ServiceNo = $_POST["ServiceNo"];
$ServiceName = $_POST["ServiceName"];

$TherapistNo = $_POST["TherapistNo"];
$Price = $_POST["Price"];
$Duration = $_POST["Duration"];



if ($_GET["job"] == "add")
{	
	$statement = $con->prepare("INSERT INTO Offers VALUES (?,?,?,?)");
	$statement->bind_param("iiii", $TherapistNo, $ServiceNo, $Price, $Duration);
	$statement->execute();
	echo "New Service added<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Offers SET TherapistNo = ?, ServiceNo = ?, Price = ?, Duration = ? WHERE TherapistNo = ? AND ServiceNo = ?");
	$statement->bind_param("iiiiii", $TherapistNo, $ServiceNo, $Price, $Duration, $TherapistNo, $ServiceNo);
	$statement->execute();
	echo "Service updated<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$TherapistNo = $_GET["TherapistNo"];
	$ServiceNo = $_GET["ServiceNo"];
	$statement = $con->prepare("DELETE FROM Offers WHERE TherapistNo = ? AND ServiceNo = ?");
	$statement->bind_param("ii", $TherapistNo, $ServiceNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~ No rows updated ~<br><br>');  // check for errors with the operation

	echo "Service Removed for<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Staff, Therapist WHERE Staff.StaffNo = Therapist.StaffNo");
echo "Click a Therapist to view/modify the services they offer: <br><br>
<table border='1'>
<tr>
<th>Therapist</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr><td><a href='therapist-offers-services-view2.php?StaffNo=" . $row['StaffNo'] . "'>" . $row['Fname'] . " " . $row['Lname'] ."</a></td></tr>";
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
