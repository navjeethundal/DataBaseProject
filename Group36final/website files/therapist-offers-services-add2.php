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

$TherapistNo = $_GET["TherapistNo"];
$ServiceNo = $_GET["ServiceNo"];
//$ServiceName = $_GET["ServiceName"];  don't think I need this


echo "Specify details for this new service:<br><br>";
?>

<form action="therapist-offers-services-view.php?job=add" method="post">
   <input name="TherapistNo" type="hidden" value=<?php echo $TherapistNo;?>>
   <input name="ServiceNo" type="hidden" value=<?php echo $ServiceNo;?>>
   Duration (in minutes): <input type="number" name="Duration" value=''><br>
   Price: <input type="number" name="Price" value='$'><br>
   <input type="submit" value="add">
</form>
  
</div>
</body>
</html>