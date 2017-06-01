<?php
  session_start();
  include("connect.php");

?>
<html>
	<head>
		<title>Online car sharing</title>
	</head>

	<body>

  <?php 

  $pass_err = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["password"] != $_POST["password2"]) {
      $pass_err = "* Password are different";
    } 
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {

	       //$_POST[f_name] = mysql_escape_string(unescaped_string);
	       //$result = htmlentities($s);

      $query = $connection->query("SELECT username FROM Users WHERE username='$_POST[username]'");
      $count = $query->rowCount();
      if ($count) {
        echo "This username already exists. Think of another username";
      } else {

       	$pass = $_POST['password'];
       	$salt = salt($pass);
       	$enc_pass = encode($pass, $salt);

        //echo $pass;
        //echo $salt;
        //echo $enc_pass;

		    $query = $connection->query("INSERT INTO Users (username, first_name, last_name, email, address, birth_date, password, salt) VALUES ('$_POST[username]', '$_POST[f_name]', '$_POST[l_name]', '$_POST[email]', '$_POST[address]', '$_POST[birth]', '$enc_pass', '$salt')");

		    $query = $connection->query("SELECT id FROM Users WHERE username='$_POST[username]' and first_name='$_POST[f_name]' and last_name='$_POST[l_name]' and birth_date='$_POST[birth]'");

		    $count = $query->rowCount();
		    if ($count==1) {
		      echo "Registration successfull";
		    }
        else echo"Registration unsuccessfull";
	  	}         
    }
  }

  ?>

   <h1>Online car sharing application</h1>

   <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <table><tr>
   <td>Username:</td>
   <td><input type="text" name="username" size="16" maxlength="20" required="true">*</td>
   </tr><tr>
   <td>First name:</td>
   <td><input type="text" name="f_name" size="16" maxlength="20" required="true" >*</td>
   </tr><tr>
   <td>Last name:</td>
   <td><input type="text" name="l_name" size="16" maxlength="20" required="true" >*</td>
   </tr><tr>   
   <td>Email:</td>
   <td><input type="text" name="email" size="16" required="false"></td>
   </tr><tr> 
   <td>Home address:</td>
   <td><input type="text" name="address" size="16" required="false"></td>
   </tr><tr>
   <td>Birth date:</td>
   <td><input type="date" name="birth" size="16" maxlength="20" required="true">*</td>
   </tr><tr>
   <td>Password:</td>
   <td><input type="password" name="password" size="16" maxlength="20" required="true">*</td>
   </tr><tr>
   <td>Confirm password:</td>
   <td><input type="password" name="password2" size="16" maxlength="20" required="true">*</td>
   <span class="error"><?php echo $pass_err;?></span>
   </tr></table>
   <br>
   <button name="submit" type="submit">Create an account</button></form> <br/>


   <form action="index.php">
   <button name="submit" type="submit">Log in</button></form><br/>

   
   

</body>
</html>



