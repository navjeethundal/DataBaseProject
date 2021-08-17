<?php
ob_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>

<div style="margin: auto; width: 50%; height: 200px; position: relative; top: 100px">
<!DOCTYPE html>
<html>
    <body>
        <div class = "heading">
            <img src="logo.png">
        </div>


<?php


echo '<br>Welcome to the booking system\'s back end... <br>';

echo "<br><br><br>Staff Options:<br><br>
<a href=\"view-staff.php\">Staff</a><br>
<a href=\"service-view.php\">Services</a><br>
<a href=\"therapist-view.php\">Therapists</a><br>
<a href=\"therapist-offers-services-view.php\">Therapist Services</a><br>
<a href=\"receptionist-view.php\">Receptionists</a><br>
<a href=\"reception_shift-view.php\">Receptionist Shifts</a><br>
<a href=\"time_off-view.php\">Time-Off</a><br>
<a href=\"sale-view.php\">Sales</a><br>
<a href=\"client-view.php\">Client</a><br>
<a href=\"waitlist-view.php\">WaitList</a><br>
<a href=\"appointment-view.php\">Appointment</a><br>";

?>

<div style="margin-top: 50px">	
	<form action = "logout.php">
    	<input type = "submit" value = "Logout">
 	</form>
</div>
	<form action = "index.php">
    	<input type = "submit" value = "Home Page">
 	</form>

</div>



</body>
</html>