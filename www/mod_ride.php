<?php
  session_start();
  include("connect.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['change']) {

      $stmt = $connection->query("SELECT * FROM Rides WHERE id = '$_POST[change_id]'");
       $result = $stmt->fetch(PDO::FETCH_ASSOC);

       $ride_date = $result['date'];
       $ride_hour = $result['hour'];
       $ride_start = $result['start'];
       $ride_dest = $result['destination'];
       $ride_places = $result['places'];
      } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['changex']) {
     

         $query = $connection->query("UPDATE Rides SET `date`='$_POST[date]', hour='$_POST[hour]', start='$_POST[start]', destination='$_POST[destination]', places='$_POST[PLaces]' WHERE id='$_POST[change_id]'");

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
   <td>Date:</td>
   <td><input type="text" name="date" size="16" value="<?php echo $ride_date?>"></td>
   </tr><tr>
   <td>Hour:</td>
   <td><input type="text" name="Hour" size="16" value="<?php echo $ride_hour?>"></td>
   </tr><tr>
   <td>start:</td>
   <td><input type="text" name="start" size="16" value="<?php echo $ride_start?>"></td>
   </tr><tr>
   <td>Destination:</td>
   <td><input type="text" name="Destination" size="16" value="<?php echo $ride_dest?>"></td>
   </tr><tr>
   <td>PLaces:</td>
   <td><input type="text" name="PLaces" size="16" value="<?php echo $ride_places?>"></td>
   </tr></table>
   
   <input type='hidden' name="changex" value=true></input>
   <button name="submit" type="submit">Change</button></form> </br>



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