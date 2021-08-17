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

$TransactionNo = $_GET["TransactionNo"];

// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Sale WHERE TransactionNo = ?");
$statement->bind_param("i", $TransactionNo);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement->bind_result($xTransactionNo, $xAday, $xAtime, $xTherapistNo, $xServiceNo, $xClientEmail, $xPaymentMethod);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $TransactionNo = $xTransactionNo;
  $Aday = $xAday;
  $Atime = $xAtime;
  $TherapistNo = $xTherapistNo;
  $ServiceNo = $xServiceNo;
  $ClientEmail = $xClientEmail;
  $PaymentMethod = $xPaymentMethod;
}



// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update sale number:  " . $TransactionNo . "<br><br>";
?>


 <form action="sale-view.php?job=update" method="post">
   <input name="TransactionNo" type="hidden" value=<?php echo $TransactionNo;?>>
   Day: <input type="text" name="Aday" value='<?php echo $Aday;?>'><br>
   Time : <input type="text" name="Atime" value='<?php echo $Atime;?>'><br>
   Therapist Number: <input type="number" name="TherapistNo" value='<?php echo $TherapistNo;?>'><br>
   Service Number: <input type="number" name="ServiceNo" value='<?php echo $ServiceNo;?>'><br>
   Client Email: <input type="text" name="ClientEmail" value='<?php echo $ClientEmail;?>'><br>
   Payment Method: <input type="text" name="PaymentMethod" value='<?php echo $PaymentMethod;?>' ><br>
   <input type="submit" value="update">
</form>
  
</div>
</body>
</html>