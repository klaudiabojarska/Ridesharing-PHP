<?php
  session_start();
  include("connect.php");
?>

<html>
   <head>
      <title>Online car sharing</title>
   </head>

<body>

  <h1>Online car sharing app</h1>
  <h2>Add a car</h2>

<form action="<?php echo $SCRIPT_NAME ?>" method="post">
  <table> <tr>
  <td>Brand and model:</td>
  <td><input type="text" name="car" size="30" maxlength="30" required="true"></td>
  </tr></table>
  <br>
  <button name="submit" type="submit">Add</button></form> <br/>

  <form action="modify.php">
  <button name="submit" type="submit">Go back</button></form><br/>
   
<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $query = $connection->query("INSERT INTO Cars (car, driver_id) VALUES ('$_POST[car]', '$_SESSION[id]')");
		?> 
            <div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Success!</strong> Car is added.
            </div> <?php
	}
	
	?>

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



