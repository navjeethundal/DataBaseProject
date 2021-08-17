<html>
<body>
<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">


<a href="https://www.iwanttowalkagain.com/user471/">BACK TO HOME PAGE</a><br><br><br>
<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");
// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();




$result = mysqli_query($con, "SELECT * FROM Staff");
echo "<strong><big>Staff</big><strong><br><br>
<table border='1'>
<tr>
<th>StaffNo</th>
<th>Fname</th>
<th>Lname</th>
<th>Email</th>
<th>Password</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "<td>" . $row['Fname'] . "</td>";
	echo "<td>" . $row['Lname'] . "</td>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td>" . $row['Password'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Therapist");
echo "<strong><big>Therapist</big><strong><br><br>
<table border='1'>
<tr>
<th>StaffNo</th>
<th>MonthlyRoomRent</th>
<th>WagePercentage</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "<td>" . $row['MonthlyRoomRent'] . "</td>";
	echo "<td>" . $row['WagePercentage'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Receptionist");
echo "<strong><big>Receptionist</big><strong><br><br>
<table border='1'>
<tr>
<th>StaffNo</th>
<th>HourlyWage</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "<td>" . $row['HourlyWage'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Reception_Shift");
echo "<strong><big>Reception_Shift</big><strong><br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>ReceptionistNo</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['ReceptionistNo'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Staff_Availability");
echo "<strong><big>Staff_Availability</big><strong><br><br>
<table border='1'>
<tr>
<th>Availability</th>
<th>StaffNo</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Availability'] . "</td>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Time_Off");
echo "<strong><big>Time_Off</big><strong><br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>StaffNo</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['StaffNo'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Service");
echo "<strong><big>Service</big><strong><br><br>
<table border='1'>
<tr>
<th>ServiceNo</th>
<th>ServiceName</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ServiceName'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Offers");
echo "<strong><big>Offers</big><strong><br><br>
<table border='1'>
<tr>
<th>TherapistNo</th>
<th>ServiceNo</th>
<th>Price</th>
<th>Duration</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['Price'] . "</td>";
	echo "<td>" . $row['Duration'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Client");
echo "<strong><big>Client</big><strong><br><br>
<table border='1'>
<tr>
<th>Email</th>
<th>Phone_Num</th>
<th>Fname</th>
<th>Lname</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td>" . $row['Phone_Num'] . "</td>";
	echo "<td>" . $row['Fname'] . "</td>";
	echo "<td>" . $row['Lname'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Client_Tag");
echo "<strong><big>Client_Tag</big><strong><br><br>
<table border='1'>
<tr>
<th>Tag</th>
<th>ClientEmail</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Tag'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Appointment");
echo "<strong><big>Appointment</big><strong><br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>TherapistNo</th>
<th>ServiceNo</th>
<th>ClientEmail</th>
<th>ApprovStaffNo</th>
<th>Notes</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "<td>" . $row['ApprovStaffNo'] . "</td>";
	echo "<td>" . $row['Notes'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM WaitList_Request");
echo "<strong><big>WaitList_Request</big><strong><br><br>
<table border='1'>
<tr>
<th>Day</th>
<th>Time</th>
<th>TherapistNo</th>
<th>ServiceNo</th>
<th>ClientEmail</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Day'] . "</td>";
	echo "<td>" . $row['Time'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



$result = mysqli_query($con, "SELECT * FROM Sale");
echo "<strong><big>Sale</big><strong><br><br>
<table border='1'>
<tr>
<th>TransactionNo</th>
<th>Aday</th>
<th>Atime</th>
<th>TherapistNo</th>
<th>ServiceNo</th>
<th>ClientEmail</th>
<th>PaymentMethod</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['TransactionNo'] . "</td>";
	echo "<td>" . $row['Aday'] . "</td>";
	echo "<td>" . $row['Atime'] . "</td>";
	echo "<td>" . $row['TherapistNo'] . "</td>";
	echo "<td>" . $row['ServiceNo'] . "</td>";
	echo "<td>" . $row['ClientEmail'] . "</td>";
	echo "<td>" . $row['PaymentMethod'] . "</td>";
	echo "</tr>";
}
echo "</table><br><br>";



mysqli_close($con); 

?>


</div>
</body>
</html>





























