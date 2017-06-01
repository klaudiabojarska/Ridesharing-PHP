<?php
  session_start();
  include("connect.php");
?>

<html>
  <head>
    <title>Online car sharing</title>
  </head>

  <body>
    <h1>Online car sharing application</h1>
    <form action="verify.php" method="post">
    <table> <tr>
    <td>Username:</td>
    <td><input type="text" name="username" size="20" maxlength="20" required="true"></td>
    </tr><tr>
    <td>Password:</td>
    <td><input type="password" name="password" size="20" required="true"></td>
    </tr></table><br/>
    <button name="submit" type="submit">Log in</button></form>

    <?php
     echo $_SESSION['message'];
     $_SESSION['message']="";

    ?>
    <br>
    <p>Are you a new user?
    <a href="registration.php">Register now</a>  
    </p>


   </body>
</html>