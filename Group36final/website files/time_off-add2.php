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
$StaffNo = $_GET["StaffNo"];
echo "Add Time-Off for:  " . $StaffNo . "<br><br>";
?>

<form action="time_off-view.php?job=add" method="post">
   <input name="StaffNo" type="hidden" value=<?php echo $StaffNo;?>>
   Day: <input type="text" name="Day"><br>
   Time: <input type="text" name="Time"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>



