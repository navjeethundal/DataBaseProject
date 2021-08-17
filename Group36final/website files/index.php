<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">
<!DOCTYPE html>
<html>
    <body>
        <div class = "heading">
            <img src="logo.png">
        </div>


<?php

/* Connecting Code
	// Create connection 
	$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

	// Check connection
	if (mysqli_connect_errno($con))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	else 
		echo "Connection was successful!<br>";
*/


echo '<br>Welcome to Healthy By Nature\'s Appointment Booking System!<br><br>';

echo '<a href="https://www.iwanttowalkagain.com/user471/make-appointment1.php">Book an Appointment</a><br><br>';

echo '<a href="https://www.iwanttowalkagain.com/user471/staff-login.php">Staff Login</a> <br><br> ';



/*
//Function for inserting a new Staff 
//	(Inputs: StaffNo, Fname, Lname, Email)
function insertStaff($StaffNo, $Fname=null, $Lname=null, $Email=null, $Password=null){
	$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
	if (mysqli_connect_errno($con))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	else 
		echo "Connection was successful!<br>";
	
	$statement = $con->prepare("INSERT INTO Staff VALUES (?,?,?,?,?)");
	$statement->bind_param('issss', $StaffNo, $Fname, $Lname, $Email, $Password);		//Note, the 'issss' notates the type (i=int, s=string)
	$statement->execute();
	
	mysqli_close($con);
}


//Function for selecting Staff 
//	(Inputs: StaffNo, Fname, Lname, Email)
function selectStaff($StaffNo, $Fname, $Lname, $Email){
	$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
	if (mysqli_connect_errno($con))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	else 
		echo "Connection was successful!<br>";
	
	
	//This way deals with injection NOTE: get result does NOT work in this SQL
	$statement = $con->prepare("SELECT * FROM Staff WHERE StaffNo = ? AND Fname = ? AND Lname = ? AND Email = ?");
	$statement -> bind_param('isss', $StaffNo, $Fname, $Lname, $Email);
	$statement -> execute();
	
	$statement->store_result();
	$num_of_rows = $stmt->num_rows;
	$statement->bind_result($StaffNo, $Fname, $Lname, $Email, $Password); //https://secure.php.net/manual/en/mysqli-stmt.bind-result.php
	
	mysqli_close($con);
	return $statement;
}

//TEST
echo "TESTING <br>";
insertStaff(12345678, "Alt", "Esp", "12345@email.com", "abc");
insertStaff(11111111, "O", "G", "asdfg@email.com", "abc");
insertStaff(12345667, "Sim", "Son", "12345@email.com", "abc");
insertStaff("00000000", "Alt", "Esp", "12345@email.com", "abc");
$resultStaff = selectStaff(00000000, "Alt", "Esp", "12345@email.com");

//Table display 
echo "Hi <table border='1'><tr><th>StaffNo</th><th>Fname</th><th>Lname</th><th>Email</th></tr>";
while($resultStaff->fetch())
{
	echo "<tr>";
	echo "<td>" . $StaffNo . "</td>";
	echo "<td>" . $Fname . "</td>";
	echo "<td>" . $Lname . "</td>";
	echo "<td>" . $Email . "</td>";
	echo "</tr>";
}	
echo "</table>";


echo "What's up boys.<br>You can your .php files to this folder to test them out and develop the site<br><br>";

*/
?>

</body>
</html>