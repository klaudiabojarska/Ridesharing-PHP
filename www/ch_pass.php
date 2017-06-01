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

       	$pass = $_POST['password'];
       	$salt = salt($pass);
       	$enc_pass = encode($pass, $salt);

        //echo $pass;
        //echo $salt;
        //echo $enc_pass;

		    $query = $connection->prepare("UPDATE Users SET password = ?, salt = ? WHERE id = '$_SESSION[id]'");
        $query->bindParam(1, $enc_pass, PDO::PARAM_STR, 40);
        $query->bindParam(2, $salt, PDO::PARAM_STR, 20);
        $query->execute();

		    ?> 
		    <div class="alert success">
		      <span class="closebtn">&times;</span>
		      <strong>Success!</strong> Password changed.
		    </div> <?php 
		    }
        else {?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <strong>Cannot change!</strong> Something went wrong.
        </div> <?php
	  	}  
	  }       


  ?>

   <h1>Online car sharing application</h1>
   <p>Change your password</p>
   <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <table><tr>
   <td>Password:</td>
   <td><input type="password" name="password" size="16" maxlength="20" required="true">*</td>
   </tr><tr>
   <td>Confirm password:</td>
   <td><input type="password" name="password2" size="16" maxlength="20" required="true">*</td>
   <span class="error"><?php echo $pass_err;?></span>
   </tr></table>
   <br>
   <button name="submit" type="submit">Change password</button></form> <br/>


   <form action="modify.php">
   <button name="submit" type="submit">Go back</button></form><br/>

   
	</style>

	  <script>
	  var close = document.getElementsByClassName("closebtn");
	  var i;

	  for (i = 0; i < close.length; i++) {
	      close[i].onclick = function() {
	          var div = this.parentElement;
	          div.style.opacity = "0";
	          setTimeout(function(){ div.style.display = "none"; }, 600);
	      }
	  }
	</script>

   

</body>
</html>



