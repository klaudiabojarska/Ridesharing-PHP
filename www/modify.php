<?php
  session_start();
  include("connect.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['change']) {

      $stmt = $connection->query("SELECT * FROM Users WHERE username = '$_POST[username]'");
      $count = $stmt->rowCount();
      if ($count && $_POST['username'] != $_SESSION['username']) { 
        ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <strong>Cannot change!</strong> This username already exits.
        </div> <?php
      } else {

         $query = $connection->query("UPDATE Users SET username='$_POST[username]', first_name='$_POST[f_name]', last_name='$_POST[l_name]', email='$_POST[email]', address='$_POST[address]', birth_date='$_POST[b_date]' WHERE id='$_SESSION[id]'");
             
         $_SESSION['username'] = $_POST["username"];
         $_SESSION['f_name'] = $_POST['f_name'];
         $_SESSION['l_name'] = $_POST["l_name"];
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['address'] = $_POST['address'];
         $_SESSION['b_date'] = $_POST["b_date"];
         ?> 
            <div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Success!</strong> Change was saved.
            </div> <?php
      }
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['ch_car']) {
    $query2 = $connection->prepare("UPDATE Cars SET car=? WHERE id=?");
    $query2->bindParam(1, $_POST['car'], PDO::PARAM_STR, 30);
    $query2->bindParam(2, $_POST['ch_car_id'], PDO::PARAM_INT);
    $query2->execute();
    ?> 
    <div class="alert success">
      <span class="closebtn">&times;</span>
      <strong>Success!</strong> Change was saved.
    </div> <?php
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['del_car']) {
    $query3 = $connection->prepare("DELETE FROM Cars WHERE id=?");
    $query3->bindParam(1, $_POST['del_car_id'], PDO::PARAM_INT);
    $query3->execute();
    ?>
      <div class="alert info">
        <span class="closebtn">&times;</span>
        Car deleted.
      </div> <?php
    }


?>

<html>
   <head>
   <title>Online car sharing</title>
   </head>
   <style>
	table, th, td {
	    border: 0px solid black;
	}
	th, td {
	    padding: 5px;
	}
</style>
<body>
   <h1>Online car sharing application</h1>
   <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <table><tr>
   <td>Username:</td>
   <td><input type="text" name="username" size="16" value="<?php echo $_SESSION['username']?>"></td>
   </tr><tr>
   <td>Firstname:</td>
   <td><input type="text" name="f_name" size="16" value="<?php echo $_SESSION['f_name']?>"></td>
   </tr><tr>
   <td>Lastname:</td>
   <td><input type="text" name="l_name" size="16" value="<?php echo $_SESSION['l_name']?>"></td>
   </tr><tr>
   <td>Email address:</td>
   <td><input type="text" name="email" size="16" value="<?php echo $_SESSION['email']?>"></td>
   </tr><tr>
   <td>Home address:</td>
   <td><input type="text" name="address" size="16" value="<?php echo $_SESSION['address']?>"></td>
   </tr><tr>
   <td>Birth date:</td>
   <td><input type="date" name="b_date" size="16" value=<?php echo $_SESSION['b_date']?>></td>
   </tr></table>
   
   <input type='hidden' name="change" value="true"></input>
   <button name="submit" type="submit">Change</button></form> </br>

   <p>Your cars:</p>

  <form action="<?php echo $SCRIPT_NAME ?>" method="post">
	<table border="1"><tr>
	<?php 
	$stmt2 = $connection->query("SELECT * FROM Cars WHERE driver_id = '$_SESSION[id]'");
    $i = 1;
	foreach($stmt2 as $row) { ?>
	<tr>
	<td><?php echo $i++?>) </td>
	<td><input type="text" name="car" size="16" value="<?php echo $row['car']?>"></td>
	<td> <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <input type='hidden' name="ch_car" value=true></input>
   <input type='hidden' name="ch_car_id" value="<?php echo $row['id']?>"></input>
   <button name="change" type="submit">Change</button> </form></td>

   <td> <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <input type='hidden' name="del_car" value=true></input>
   <input type='hidden' name="del_car_id" value="<?php echo $row['id']?>"></input>
   <button name="delete" type="submit">Delete</button> </form></td>
	</tr>
	<?php

	}?>
	</tr>
	</table></form>

  

  <form action="add_car.php">
  <button name="submit" type="submit">Add a new car</button></form>

  <form action="ch_pass.php">
  <button name="submit" type="submit">Change your password</button></form>

   <form action="account.php">
   <button name="submit" type="submit">Go back</button></form> 
   

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