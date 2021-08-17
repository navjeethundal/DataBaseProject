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

Add a new Client member:<br><br>

<form action="client-view.php?job=add" method="post">
   Client Email: <input type="text" name="Email"><br>
   Phone Number: <input type="text" name="Phone_Num"><br>
   First Name: <input type="text" name="Fname"><br>
   Last Name: <input type="text" name="Lname"><br>
   <input type="submit" value="add">
</form>



</div>
</body>
</html>