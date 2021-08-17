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


$TherapistNo = $_GET["TherapistNo"];
$ServiceNo = $_GET["ServiceNo"];



// // print out therapist's availability
// $result = mysqli_query($con, "SELECT * FROM Staff_Availability WHERE StaffNo = " . $TherapistNo);

// echo "This therapist is available during these times:<br><br>
// <table border='1'>";

// while ($row = mysqli_fetch_array($result)){
//   echo "<tr>";
//   echo "<td>" . $row['Availability'] . "</td>";
//   echo "</tr>";
// }
// echo "</table><br><br><br>";




// now show all appointments that Staff member has
$result = mysqli_query($con, "SELECT * FROM Appointment WHERE TherapistNo = " . $TherapistNo);

echo "This therapist is currently booked (unavailable during these times):<br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
  echo "<tr>";
  echo "<td>" . $row['Day'] . "</td>";
  echo "<td>" . $row['Time'] . "</td>";
  echo "</tr>";
}
echo "</table><br><br>";



// --- Staff SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Staff WHERE StaffNo = ?");
$statement->bind_param("i", $TherapistNo);
$statement->execute();
$statement->store_result();
//if ($statement->num_rows === 0) exit('Your SELECT query didn\'t return anything(1). Exiting the script...'); // error check

$statement->bind_result($xStaffNo, $xFname, $xLname, $xEmail, $xPassword);

while($statement->fetch()) { 
  $Fname = $xFname;
  $Lname = $xLname;
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


mysqli_close($con); 

echo "You are booking a " . $ServiceName . " appointment with " . $Fname . " " . $Lname . "<br>
Please complete the details for this appointment, below:<br><br>";
?>


<form action="make-appointment1.php?job=add" method="post">
   <input name="TherapistNo" type="hidden" value=<?php echo $TherapistNo;?>>
   <input name="ServiceNo" type="hidden" value=<?php echo $ServiceNo;?>>
   Desired Appointment Day: <input type="text" name="Day" value='DD-MM-YYYY'><br>
   Desired Appointment Time: <input type="text" name="Time" value='X AM/PM'><br>
   Your First Name: <input type="text" name="Fname"><br>
   Your Last Name: <input type="text" name="Lname"><br>
   Your email: <input type="text" name="ClientEmail"><br>
   Your phone number: <input type="text" name="Phone_Num"><br>
   Any notes or requests?: <input type="text" name="Notes"><br>
   <input type="submit" value="add">
</form>



<br><br>
<form action = "index.php">
   	<input type = "submit" value = "Go Back">
</form>

</div>


</body>
</html>
