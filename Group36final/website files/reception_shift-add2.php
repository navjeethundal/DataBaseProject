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
<div style="margin: auto; width: 30%; height: 200px; position: relative; top: 100px">

<?php

$StaffNo = $_GET["StaffNo"];

// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Staff WHERE StaffNo = ?");
$statement->bind_param("i", $StaffNo);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything(1). Exiting the script...'); // error check

$statement->bind_result($xStaffNo, $xFname, $xLname, $xEmail, $xPassword);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $Fname = $xFname;
  $Lname = $xLname;
}

//RECEPTION SHIFT PART
// Safe way to execute SELECT ---------------------------------------------
$statement2 = $con->prepare("SELECT * FROM Reception_Shift WHERE ReceptionistNo = ?");
$statement2->bind_param("i", $StaffNo);
$statement2->execute();
$statement2->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything(2). Exiting the script...'); // error check

$statement2->bind_result($xDay, $xTime, $xReceptionistNo);

while($statement2->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $shiftDays[] = $xDay;
  $shiftTimes[] = $xTime;
}

// ------ / SELECT --------------------------------------------------------

// Display current shifts for this receptionist -------
$result = mysqli_query($con, "SELECT * FROM Reception_Shift WHERE ReceptionistNo = " . $StaffNo);
echo "Current shifts for " . $Fname . " " . $Lname . ": <br><br>
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
echo "</table><br><br><br>";
// ----------------------------------------------------



mysqli_close($con);
echo "Add a shift:<br>";
?>

<form action="reception_shift-view.php?job=add" method="post">
   <input name="ReceptionistNo" type="hidden" value=<?php echo $StaffNo;?>>
   Day: <input type="text" name="Day" value='enter shift day'><br>
   Time: <input type="text" name="Time" value='enter shift time'><br>
   <input type="submit" value="add">
</form>
  
</div>
<div style="position: absolute; right: 0px; top: 10px; width: 200px; height: 50px;">Logout button could go here</div>
</body>
</html>