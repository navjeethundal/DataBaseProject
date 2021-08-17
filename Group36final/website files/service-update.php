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

$ServiceNo = $_GET["ServiceNo"];

// Create connection
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


// Safe way to execute SELECT ---------------------------------------------
$statement = $con->prepare("SELECT * FROM Service WHERE ServiceNo = ?");
$statement->bind_param("i", $ServiceNo);
$statement->execute();
$statement->store_result();

if ($stmt->num_rows === 0) exit('Your SELECT query didn\'t return anything. Exiting the script...'); // error check

$statement->bind_result($xServiceNo, $xServiceName);

while($statement->fetch()) {  // f-ing annoying, but you seem to have to do this...
  $ServiceNo = $xServiceNo;
  $ServiceName = $xServiceName;
}

// ------ / SELECT --------------------------------------------------------

mysqli_close($con);
echo "Update service:  " . $ServiceName . "<br><br>";
?>


 <form action="service-view.php?job=update" method="post">
   <input name="ServiceNo" type="hidden" value=<?php echo $ServiceNo;?>>
   Service Name: <input type="text" name="ServiceName" value='<?php echo $ServiceName;?>'><br>
   <input type="submit" value="update">
</form>
  


</div>
</body>
</html>