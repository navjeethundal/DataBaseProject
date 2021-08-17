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
// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

$TherapistNo = $_GET["TherapistNo"];



$result = mysqli_query($con, "SELECT * FROM Service");
echo "Select the type of service you'd like to add  <br><br>
<table border='1'>
<tr>
<th>Service</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td><a href='therapist-offers-services-add2.php?TherapistNo=" . $TherapistNo . "&amp;ServiceNo=" . $row['ServiceNo'] . "&amp;ServiceName=" . $row['ServiceName'] . "'>" . $row['ServiceName'] . "</a></td>";
	echo "</tr>";
}
echo "</table>";


?>



</div>
</body>
</html>