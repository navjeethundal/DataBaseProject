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

Add a new service:<br><br>

<form action="service-view.php?job=add" method="post">
   Service Number: <input type="number" name="ServiceNo" min="0" max="9999"><br>
   Service Name: <input type="text" name="ServiceName"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>



