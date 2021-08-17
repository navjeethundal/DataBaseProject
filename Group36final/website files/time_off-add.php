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

Add a new Time-Off:<br><br>

<form action="time_off-view.php?job=add" method="post">
   Staff Number: <input type="number" name="StaffNo" min="0" max="9999"><br>
   Day: <input type="text" name="Day"><br>
   Time: <input type="text" name="Time"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>



