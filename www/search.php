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
   <h2>Search</h2>
   <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <table> <tr>
   <td>Day:</td>
   <td><input type="date" name="day" size="20" maxlength="20"></td>
   </tr><tr>
   <td>Hour:</td>
   <td><input type="time" name="hour" size="20"></td>
   <tr></tr>
   <td>Start:</td>
   <td><input type="text" name="start" size="20" maxlength="20"></td>
   </tr><tr>
   <td>Destination:</td>
   <td><input type="text" name="dest" size="20" maxlength="20"></td>
   </tr><tr>
   <td>Number of places:</td>
   <td><input type="text" name="places" size="20" maxlength="20" required="true" value="1"></td>
   </tr>
   </tr></table>
   <button name="search" type="submit">Search</button></form>

  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search['day'] = '%' . $_POST['day'];
    $search['hour'] = '%' . $_POST['hour'] . '%';
    $search['dest'] = '%' . $_POST['dest'];
    $search['start'] = '%' . $_POST['start'];
    $query = $connection->query("SELECT r.id as ride_id, r.date as day, hour, start, destination, places, c.id as car_id, car, driver_id FROM Rides r join Cars c ON r.car_id = c.id WHERE r.date LIKE '$search[day]' and hour LIKE '$search[hour]' and start LIKE '$search[start]' and destination like '$search[dest]' and places >= '$_POST[places]'");

    $count = $query->rowCount();
    if (!$count) {  ?>
      <div class="alert info">
      <span class="closebtn">&times;</span>
      <strong>Sorry!</strong> No ride found :(
      <p> </p>

      </div>  <?php 
    } else if (!$_POST['book']) {
      echo "Available rides: <br>";        
  ?>
      <table border="1">
      <tr>
      <th>Car</th>
      <th>From</th>
      <th>To</th> 
      <th>Day</th>
      <th>Hour</th>
      <th>Free places</th>
      <th> </th>
      </tr> <tr>
      <?php 
      

      foreach($query as $row) { ?>
        <td> <?php echo $row['car'] ?> </td>
        <td> <?php echo $row['start'] ?> </td>
        <td> <?php echo $row['destination'] ?> </td>
        <td> <?php echo $row['day'] ?> </td>
        <td> <?php echo $row['hour'] ?> </td>
        <td> <?php echo $row['places'] ?> </td>
        <td>
        <form action="<?php echo $SCRIPT_NAME ?>" method="post">
                <input type="hidden" name="book" value=true>
                <input type="hidden" name="book_id" value="<?php echo $row['ride_id']?>">
                <input type="hidden" name="book_num" value="<?php echo $_POST['places']?>">
                <button name="modify" type="submit">Book this ride</button> </form> </td>
        </tr>

      <?php } ?>
      </table>

      <?php }


      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['book']) {
          $stmt1 = $connection->prepare("UPDATE Rides SET places = places - ? WHERE id = ?");
          $stmt1->bindParam(1, $_POST['book_num'], PDO::PARAM_INT);
          $stmt1->bindParam(2, $_POST['book_id'], PDO::PARAM_INT);
          $stmt1->execute();
          $count = $stmt1->rowCount(); 
          if ($count==1){               
            ?> 
            <div class="alert success">
              <span class="closebtn">&times;</span>
              <strong>Success!</strong> Ride is booked.
            </div> <?php
          }
           
          $stmt2 = $connection->prepare("INSERT INTO Reservations (user_id, ride_id) VALUES (?, ?)");
          $stmt2->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
          $stmt2->bindParam(2, $_POST['book_id'], PDO::PARAM_INT);
          $stmt2->execute();
        }
      }
  }
  ?>

    
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

  </br>
  <form action="account.php">
  <button name="submit" type="submit">Go back</button></form><br/>

</body>
</html>