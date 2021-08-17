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


$result = mysqli_query($con, "SELECT * FROM Receptionist, Staff WHERE Staff.StaffNo = Receptionist.StaffNo");
echo "Select a receptionist to schedule a shift for: <br><br>
<table border='1'>
<tr>
<th>Receptionist</th>
</tr>";

while ($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td><a href='reception_shift-add2.php?StaffNo=" . $row['StaffNo'] . "'>" . $row['Fname'] . " " . $row['Lname'] . "</a></td>";
	echo "</tr>";
}
echo "</table>";


?>



</div>
<div style="position: absolute; right: 0px; top: 10px; width: 200px; height: 50px;">Logout button could go here</div>
</div>
</body>
</html>