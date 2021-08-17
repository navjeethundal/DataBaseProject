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

$ClientEmail = $_GET["ClientEmail"];

// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM WaitList_Request WHERE ClientEmail = ?");
$statement->bind_param("s", $ClientEmail);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement->bind_result($xDay, $xTime, $xTherapistNo, $xServiceNo, $xClientEmail);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $Day = $xDay;
  $Time = $xTime;
  $TherapistNo = $xTherapistNo;
  $ServiceNo = $xServiceNo;
  $ClientEmail = $xClientEmail;
}

// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update Waitlist Request for:  " . $ClientEmail . "<br><br>";
?>


 <form action="waitlist-view.php?job=update" method="post">
   <input name="ClientEmail" type="hidden" value=<?php echo $ClientEmail;?>>
   Day: <input type="text" name="Day" value='<?php echo $Day;?>'><br>
   Time: <input type="text" name="Time" value='<?php echo $Time;?>'><br>
   Therapist No.: <input type="number" name="TherapistNo" value='<?php echo $TherapistNo;?>'><br>
   Service No.: <input type="number" name="ServiceNo" value='<?php echo $ServiceNo;?>'><br>
   <input type="submit" value="update">
</form>

</div>
</body>
</html>