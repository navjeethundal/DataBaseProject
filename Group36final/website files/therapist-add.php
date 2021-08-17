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

Add a new Therapist member:<br><br>

<form action="therapist-view.php?job=add" method="post">
   Staff Number: <input type="number" name="StaffNo" min="0" max="9999"><br>
   First Name: <input type="text" name="Fname"><br>
   Last Name: <input type="text" name="Lname"><br>
   E-mail: <input type="text" name="Email"><br>
   Account Password: <input type="text" name="Password"><br>
   Monthly Room Rent: <input type="number" name="MonthlyRoomRent"><br>
   Wage Percentage: <input type="number" name="WagePercentage"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>