<html>
<body>


<?php

// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
else 
	echo "Connection was successful!<br>";


// the query code:
$sql = "CREATE TABLE Staff (
StaffNo INT NOT NULL PRIMARY KEY, 
Fname VARCHAR(30),
Lname VARCHAR(30),
Email VARCHAR(50),
Password VARCHAR(50) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Staff table created!<br>";


$sql = "CREATE TABLE Therapist (
StaffNo INT, 
MonthlyRoomRent INT,
WagePercentage INT,
FOREIGN KEY (StaffNo) REFERENCES Staff(StaffNo));";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Therapist table created!<br>";


$sql = "CREATE TABLE Receptionist (
StaffNo INT, 
HourlyWage INT,
FOREIGN KEY (StaffNo) REFERENCES Staff(StaffNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Receptionist table created!<br>";


$sql = "CREATE TABLE Client (
Email varchar(50) NOT NULL PRIMARY KEY, 
Phone_Num varchar(20),
Fname varchar(30),
Lname varchar(30) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Client table created!<br>";


$sql = "CREATE TABLE Service (
ServiceNo int NOT NULL PRIMARY KEY,
ServiceName varchar(50) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Service table created!<br>";


$sql = "CREATE TABLE Reception_Shift (
Day varchar(30) NOT NULL,
Time varchar(30) NOT NULL,
ReceptionistNo int,
PRIMARY KEY (Day, Time, ReceptionistNo),
FOREIGN KEY (ReceptionistNo) REFERENCES Receptionist(StaffNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Reception_Shift table created!<br>";


$sql = "CREATE TABLE Appointment (
Day varchar(30) NOT NULL,
Time varchar(30) NOT NULL,
TherapistNo int,
ServiceNo int,
ClientEmail varchar(50),
ApproveStaffNo int,
Notes varchar(255),
PRIMARY KEY (Day, Time, TherapistNo, ServiceNo, ClientEmail),
FOREIGN KEY (TherapistNo) REFERENCES Therapist(StaffNo),
FOREIGN KEY (ServiceNo) REFERENCES Service(ServiceNo),
FOREIGN KEY (ClientEmail) REFERENCES Client(Email),
FOREIGN KEY (ApproveStaffNo) REFERENCES Staff(StaffNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Appointment table created!<br>";


$sql = "CREATE TABLE Time_Off (
Day varchar(30) NOT NULL,
Time varchar(30) NOT NULL,
StaffNo int,
PRIMARY KEY (Day, Time, StaffNo),
FOREIGN KEY (StaffNo) REFERENCES Staff(StaffNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Time_Off table created!<br>";


$sql = "CREATE TABLE WaitList_Request (
Day varchar(30) NOT NULL,
Time varchar(30) NOT NULL,
TherapistNo int,
ServiceNo int,
ClientEmail varchar(50),
PRIMARY KEY (Day, Time, TherapistNo, ServiceNo, ClientEmail),
FOREIGN KEY (TherapistNo) REFERENCES Therapist(StaffNo),
FOREIGN KEY (ServiceNo) REFERENCES Service(ServiceNo),
FOREIGN KEY (ClientEmail) REFERENCES Client(Email) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "WaitList_Request table created!<br>";


$sql = "CREATE TABLE Offers (
TherapistNo int,
ServiceNo int,
Price int,
Duration int,
PRIMARY KEY (TherapistNo, ServiceNo),
FOREIGN KEY (TherapistNo) REFERENCES Therapist(StaffNo), 
FOREIGN KEY (ServiceNo) REFERENCES Service(ServiceNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Offers table created!<br>";


$sql = "CREATE TABLE Sale (
TransactionNo int NOT NULL PRIMARY KEY,
Aday varchar(30) NOT NULL,
Atime varchar(30) NOT NULL,
TherapistNo int,
ServiceNo int,
ClientEmail varchar(50),
PaymentMethod varchar(30),
FOREIGN KEY (Aday) REFERENCES Appointment(Day),
FOREIGN KEY (Atime) REFERENCES Appointment(Time),
FOREIGN KEY (TherapistNo) REFERENCES Therapist(StaffNo),
FOREIGN KEY (ServiceNo) REFERENCES Service(ServiceNo),
FOREIGN KEY (ClientEmail) REFERENCES Client(Email) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Sale table created!<br>";


$sql = "CREATE TABLE Client_Tag (
Tag varchar(50),
ClientEmail varchar(50),
PRIMARY KEY (Tag, ClientEmail),
FOREIGN KEY (ClientEmail) REFERENCES Client(Email) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Client_Tag table created!<br>";


$sql = "CREATE TABLE Staff_Availability (
Availability varchar(50),
StaffNo int,
PRIMARY KEY (Availability, StaffNo),
FOREIGN KEY (StaffNo) REFERENCES Staff(StaffNo) );";

// execute the query
if (!mysqli_query($con,$sql))
	die('Error: ' . mysqli_error($con)); 
else
	echo "Staff_Avaiability table created!<br>";


mysqli_close($con); 

?>


</body>
</html>







