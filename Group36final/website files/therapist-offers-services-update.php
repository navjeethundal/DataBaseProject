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

$TherapistNo = $_GET["TherapistNo"];
$ServiceNo = $_GET["ServiceNo"];

// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


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

// --- Offers SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Offers WHERE TherapistNo = ? AND ServiceNo = ?");
$statement->bind_param("ii", $TherapistNo, $ServiceNo);
$statement->execute();
$statement->store_result();

$statement->bind_result($xTherapistNo, $xServiceNo, $xPrice, $xDuration);

while($statement->fetch()) { 
  $ServiceNo = $xServiceNo;
  $Price = $xPrice;
  $Duration = $xDuration;
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
echo "Update service for therapist:  " . $Fname . " " . $Lname . "<br><br>";

?>


 <form action="therapist-offers-services-view.php?job=update" method="post">
   <input name="TherapistNo" type="hidden" value=<?php echo $TherapistNo;?>>
   <input name="ServiceNo" type="hidden" value=<?php echo $ServiceNo;?>>
   <input name="Fname" type="hidden" value=<?php echo $Fname;?>>
   <input name="Lname" type="hidden" value=<?php echo $Lname;?>>
   Service: <?php echo $ServiceName;?><br>
   Duration: <input type="number" name="Duration" value=<?php echo $Duration;?>><br>
   Price: <input type="number" name="Price" value=<?php echo $Price;?>><br>
   <input type="submit" value="update">
</form>
  


</div>
<div style="position: absolute; right: 0px; top: 10px; width: 200px; height: 50px;">Logout button could go here</div>
</body>
</html>