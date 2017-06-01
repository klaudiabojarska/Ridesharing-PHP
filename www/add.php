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
  <h2>Offer a ride</h2>

  <?php


  	$query = $connection->query("SELECT CURDATE()");
	$result = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['curdate'] = $result["CURDATE()"];

	?>
	<form action="<?php echo $SCRIPT_NAME ?>" method="post">
	   <table> <tr>
	   <td>Date:</td>
	   <td><input type="date" name="date" required="true">*</td>
	   </tr><tr>
	   <td>Hour:</td>
	   <td><input type="time" name="hour" required="true">*</td>
	   </tr><tr>
	   <td>Start:</td>
	   <td><input type="text" name="start" size="16" required="true" >*</td>
	   </tr><tr>   
	   <td>Destination:</td>
	   <td><input type="text" name="dest" size="16" required="true">*</td>
	   </tr><<tr> 
	   <td>Available places:</td>
	   <td><input type="text" name="places" size="16" required="true">*</td>
	   </tr><<tr>
	   <td>Car:</td>
	   <td>
	      <form>
	        <select name="car">
	        <?php $query = $connection->query("SELECT * FROM Cars WHERE driver_id='$_SESSION[id]'");
	              foreach($query as $row)  {?>
	                <option><?php echo $row['car']?></option>
	                <?php } ?>
	        </select>
	      </form></td>
	   </tr></table>
	   <br>
	   <button name="submit" type="submit">Add ride</button>
	</form> <br/><br/>


	
    <form action="account.php">
    <button name="submit" type="submit">Go back</button></form><br/>
   
	<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
	if ($_POST['date'] < $_SESSION['curdate']) {
		?>
        <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Cannot add!</strong> You cannnot add ride in the past.
        </div> <?php
     } else {

		$query = $connection->query("SELECT * FROM Cars WHERE driver_id='$_SESSION[id]' and car ='$_POST[car]'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$car_id = $result['id'];

		$query2 = $connection->query("INSERT INTO Rides (car_id, date, hour, start, destination, places) VALUES ('$car_id', '$_POST[date]', '$_POST[hour]', '$_POST[start]', '$_POST[dest]', '$_POST[places]')");
		} 
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



