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

$Email = $_GET["Email"];
// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Client WHERE Email = ?");
$statement->bind_param("s", $Email);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement->bind_result($xEmail, $xPhone_Num, $xFname, $xLname);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $Email = $xEmail;
  $Phone_Num = $xPhone_Num;
  $Fname = $xFname;
  $Lname = $xLname;
}


/* CHANGE LATER TO Client_Tag
//THERAPIST PART
// Safe way to execute SELECT ---------------------------------------------
$statement2 = $con->prepare("SELECT * FROM Therapist WHERE StaffNo = ?");
$statement2->bind_param("i", $StaffNo);
$statement2->execute();
$statement2->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement2->bind_result($xStaffNo, $xMonthlyRoomRent, $xWagePercentage);

while($statement2->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $StaffNo = $xStaffNo;
  $MonthlyRoomRent = $xMonthlyRoomRent;
  $WagePercentage = $xWagePercentage;
}
*/


// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update Client Information:  " . $Email . "<br><br>";
?>


 <form action="client-view.php?job=update" method="post">
   <input name="Email" type="hidden" value=<?php echo $Email;?>>
   Phone_Num: <input type="text" name="Phone_Num" value='<?php echo $Phone_Num;?>'><br>
   First Name: <input type="text" name="Fname" value='<?php echo $Fname;?>'><br>
   Last Name: <input type="text" name="Lname" value='<?php echo $Lname;?>'><br>
   <input type="submit" value="update">
</form>
  
</div>
</body>
</html>