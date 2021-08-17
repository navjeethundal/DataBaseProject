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

Add a new Waitlist:<br><br>

<form action="waitlist-view.php?job=add" method="post">
   Day: <input type="text" name="Day"><br>
   Time: <input type="text" name="Time"><br>
   Therapist No.: <input type="number" name="TherapistNo"><br>
   Service No.: <input type="number" name="ServiceNo"><br>
   Client Email: <input type="text" name="ClientEmail"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>



