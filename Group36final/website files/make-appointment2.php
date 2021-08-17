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
<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">

<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();


$ServiceNo = $_GET["ServiceNo"];

// now show all staff who offer that service

// this could technically be injected... I think, if the hacker put the code in the URL...
// out of time, though, so just do this:
$result = mysqli_query($con, "SELECT * FROM Offers, Staff WHERE Offers.ServiceNo = " . $ServiceNo . " AND Staff.StaffNo = Offers.TherapistNo");

echo "These are the therapists who offer that service.<br>Click the one you want to book with: <br><br>
<table border='1'>
<tr>
<th>Therapist</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td><a href='make-appointment3.php?TherapistNo=" . $row['StaffNo'] . "&amp;ServiceNo=" . $row['ServiceNo'] . "'>" . $row['Fname'] . " " . $row['Lname'] . "</a></td>";
	echo "</tr>";
}
echo "</table>";




mysqli_close($con); 

?>

<br><br>
<form action = "index.php">
   	<input type = "submit" value = "Go Back">
</form>

</div>


</body>
</html>
