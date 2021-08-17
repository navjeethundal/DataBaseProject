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
$statement = $con->prepare("SELECT * FROM Time_Off WHERE StaffNo = ?");
$statement->bind_param("i", $StaffNo);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement->bind_result($xDay, $xTime, $xStaffNo);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $StaffNo = $xStaffNo;
  $Day = $xDay;
  $Time = $xTime;
}

// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update Time-Off for:  " . $StaffNo . "<br><br>";
?>


 <form action="time_off-view.php?job=update" method="post">
   <input name="StaffNo" type="hidden" value=<?php echo $StaffNo;?>>
   Day: <input type="text" name="Day" value='<?php echo $Day;?>'><br>
   Time: <input type="text" name="Time" value='<?php echo $Time;?>'><br>
   <input type="submit" value="update">
</form>

</div>
</body>
</html>