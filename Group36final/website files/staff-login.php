<?php
ob_start();
session_start(); 

if (isset($_SESSION['user'])) {
   header('Location: staff-home.php');
}
// Create connection 
$con = mysqli_connect("localhost","tyraelh_471admin","lol@471","tyraelh_471");

// Check connection
if (mysqli_connect_errno($con))
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>
<!DOCTYPE html>
<html>
    <head>
          <title>Staff Login In </title>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <center>
            <div class = "heading">
                <img src="logo.png">
            </div>
              <form action = "index.php">
                  <input type = "submit" value = "Go Back">
              </form>
            <div class="login">
            <form name="Login form" method="post" action="">
                <table>
                  <tr>
                    <td><b>Username</b></td>
                    <td><input type="text" name="user" placeholder="Username" required></td>
                  </tr>
                  <tr>
                    <td><b>Password</b></td>
                    <td><input type="password" name="pass" placeholder="Password" required></td>
                  </tr>
                  <tr>
                    <td colspan="2" align = "center">
                      <input type="submit" name="submitLogin" value="Log in">
                    </td>
                  </tr>
                </table>
            </form>
            </div>
        </center>
        <?php
        $flag = True;
        $query="SELECT * FROM Staff";
        $result = mysqli_query($con, $query);
        if(isset($_POST["submitLogin"])) {
          while($Staff=mysqli_fetch_assoc($result)) {
            if($Staff['Email'] == $_POST['user'] && $Staff['Password'] == $_POST['pass']) {
              $flag = False;
              $_SESSION['user'] = $_POST['user'];
              header('Location: staff-home.php');
            }
          }
          if($flag == True){
            header('Location: failed-login.php');
          }
        }
        ?>
    </body>
</html>