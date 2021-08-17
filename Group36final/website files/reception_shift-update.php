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

$ReceptionistNo = $_POST["ReceptionistNo"];
$Day = $_POST["Day"];
$Time = $_POST["Time"];


// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Staff WHERE StaffNo = ?");
$statement->bind_param("i", $ReceptionistNo);
$statement->execute();
$statement->store_result();
//if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything(1). Exiting the script...'); // error check

$statement->bind_result($xStaffNo, $xFname, $xLname, $xEmail, $xPassword);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $Fname = $xFname;
  $Lname = $xLname;
}
// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update reception shift for receptionist : " . $Fname . " " . $Lname . "<br><br>";
?>


 <form action="reception_shift-view.php?job=update" method="post">
   <input name="ReceptionistNo" type="hidden" value=<?php echo $ReceptionistNo;?>>
   <input name="PreviousDay" type="hidden" value='<?php echo $Day;?>'>
   <input name="PreviousTime" type="hidden" value='<?php echo $Time;?>'>
   First Name: <?php echo $Fname;?><br>
   Last Name: <?php echo $Lname;?><br>
   Shift Day: <input type="text" name="Day" value='<?php echo $Day;?>'><br>
   Shift Time: <input type="text" name="Time" value='<?php echo $Time;?>'><br>
   <input type="submit" value="update">
</form>
  

</div>
<div style="position: absolute; right: 0px; top: 10px; width: 200px; height: 50px;">Logout button could go here</div>
</body>
</html>