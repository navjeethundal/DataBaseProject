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
  $StaffNo = $xStaffNo;
  $Fname = $xFname;
  $Lname = $xLname;
  $Email = $xEmail;
  $Password = $xPassword;
}

//RECEPTIONIST PART
// Safe way to execute SELECT ---------------------------------------------
$statement2 = $con->prepare("SELECT * FROM Receptionist WHERE StaffNo = ?");
$statement2->bind_param("i", $StaffNo);
$statement2->execute();
$statement2->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything(2). Exiting the script...'); // error check

$statement2->bind_result($xStaffNo, $xHourlyWage);

while($statement2->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $StaffNo = $xStaffNo;
  $HourlyWage = $$xHourlyWage;
}

// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update receptionist number:  " . $StaffNo . "<br><br>";
?>


 <form action="receptionist-view.php?job=update" method="post">
   <input name="StaffNo" type="hidden" value=<?php echo $StaffNo;?>>
   First Name: <input type="text" name="Fname" value='<?php echo $Fname;?>'><br>
   Last Name: <input type="text" name="Lname" value='<?php echo $Lname;?>'><br>
   E-mail: <input type="text" name="Email" value='<?php echo $Email;?>'><br>
   Account Password: <input type="text" name="Password" value='...'><br>
   Hourly Wage: <input type="number" name="HourlyWage" value='<?php echo $HourlyWage;?>'><br>
   <input type="submit" value="update">
</form>
  
</div>
</body>
</html>