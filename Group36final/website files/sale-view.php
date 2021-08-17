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


$TransactionNo = $_POST["TransactionNo"];
$Aday = $_POST["Aday"];
$Atime = $_POST["Atime"];
$TherapistNo = $_POST["TherapistNo"];
$ServiceNo = $_POST["ServiceNo"];
$ClientEmail = $_POST["ClientEmail"];
$PaymentMethod = $_POST["PaymentMethod"];


if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Sale VALUES (?,?,?,?,?,?,?)");
	$statement->bind_param("issiiss", $TransactionNo, $Aday, $Atime, $TherapistNo, $ServiceNo, $ClientEmail, $PaymentMethod);
	$statement->execute();
	
	echo "New sale added!<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Sale SET TransactionNo = ?, Aday = ?, Atime = ?, TherapistNo = ? , ServiceNo = ?, ClientEmail = ?, PaymentMethod = ? WHERE TransactionNo = ?");
	$statement->bind_param("issiissi", $TransactionNo, $Aday, $Atime, $TherapistNo, $ServiceNo, $ClientEmail, $PaymentMethod, $TransactionNo);
	$statement->execute();
	
	echo "sale updated!<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$TransactionNo = $_GET["TransactionNo"];
	
	$statement = $con->prepare("DELETE FROM Sale WHERE TransactionNo = ?");
	$statement->bind_param("i", $TransactionNo);
	$statement->execute();
	if ($statement->affected_rows === 0) exit('~1 No rows updated ~<br><br>');  // check for errors with the operation
	

	echo "Sale removed from database!<br><br><br>";
}



$result = mysqli_query($con, "SELECT * FROM Sale, Therapist, Service, Client WHERE Sale.TherapistNo = Therapist.StaffNo AND Sale.ServiceNo = Service.ServiceNo AND Sale.ClientEmail = Client.Email");
echo "Here's all Sales: <br><br>
<table border='1'>
<tr>
<th>Transaction Number</th>
<th>Day</th>
<th>Time</th>
<th>Therapist Number</th>
<th>Service Number</th>
<th>Client Email</th>
<th>Payment Method</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['TransactionNo'] . "</td>";
	echo "<td>" . $row['Aday'] . "</td>";
	echo "<td>" . $row['Atime'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "<td>" . $row['PaymentMethod'] . "</td>";
	echo "<td><a href='sale-update.php?TransactionNo=" . $row['TransactionNo'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this sale?')\" href='sale-view.php?job=delete&amp;TransactionNo= " . $row['TransactionNo'] . "'>DELETE</a></td>";
	echo "</tr>";
	
}
echo "</table><br><br><a href=\"sale-add.php\">Add a new sale</a>";


mysqli_close($con); 

?>
	<form action = "staff-home.php">
        <input type = "submit" value = "Go Back">
    </form>
</body>
</html>
