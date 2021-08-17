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

$Email = $_POST["Email"];
$Phone_Num = $_POST["Phone_Num"];
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];

//$Tag = $_POST["Tag"];


if ($_GET["job"] == "add")
{
	$statement = $con->prepare("INSERT INTO Client VALUES (?,?,?,?)");
	$statement->bind_param("ssss", $Email, $Phone_Num, $Fname, $Lname);
	$statement->execute();
	
	//Tag insert
	//$statement2 = $con->prepare("INSERT INTO Client_Tag VALUES (?,?)");
	//$statement2->bind_param("ss", $Tag, $ClientEmail	);
	//$statement2->execute();
	echo "New Therapist member added!<br><br><br>";
} 


if ($_GET["job"] == "update")
{
	$statement = $con->prepare("UPDATE Client SET Email = ?, Phone_Num = ?, Fname = ?, Lname = ? WHERE Email = ?");
	$statement->bind_param("sssss", $Email, $Phone_Num, $Fname, $Lname, $Email);
	$statement->execute();
	
	//$statement = $con->prepare("UPDATE CLient_Tag SET Tag = ?, ClientEmail = ? WHERE ClientEmail = ?");
	//$statement->bind_param("iii", $MonthlyRoomRent, $WagePercentage, $StaffNo);
	//$statement->execute();
	//echo "Therapist member updated!<br><br><br>";
} 
  

if ($_GET["job"] == "delete")
{
	$Email = $_GET["Email"];
	
	$statement = $con->prepare("DELETE FROM Client WHERE Client.Email =?");
	$statement->bind_param("s", $Email);
	$statement->execute();
	if ($statement->affected_rows === 0) 
		exit('~1 No rows updated ~<br><br>');  // check for errors with the operation
	
	//$statement = $con->prepare("DELETE FROM Client_Tag WHERE ClientEmail = ?");
	//$statement->bind_param("s", $Email);
	//$statement->execute();
	//if ($statement->affected_rows === 0) exit('~2 No rows updated ~<br><br>');  // check for errors with the operation

	echo "Staff member removed from database!<br><br><br>";
}


	//$result = mysqli_query($con, "SELECT * FROM Client, Client_Tag WHERE Client.Email = Client_Tag.ClientEmail");
$result = mysqli_query($con, "SELECT * FROM Client");
echo "Here's all our Clients: <br><br>
<table border='1'>
<tr>
<th>Client Email/th>
<th>Phone Number/th>
<th>First Name</th>
<th>Last Name</th>
<th>update?</th>
<th>delete?</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td>" . $row['Phone_Num'] . "</td>";
	echo "<td>" . $row['Fname'] . "</td>";
	echo "<td>" . $row['Lname'] . "</td>";
	echo "<td><a href='client-update.php?Email=" . $row['Email'] . "'>Update</a></td>";
	echo "<td><a onClick= \"return confirm('Do you want to delete this client member?')\" href='client-view.php?job=delete&amp;Email=" .$row['Email']. "'>DELETE</a></td>";
	echo "</tr>";
	
}
echo "</table><br><br><a href=\"client-add.php\">Add a new client member</a>";


mysqli_close($con); 

?>
	<form action = "staff-home.php">
        <input type = "submit" value = "Go Back">
    </form>
</body>
</html>
