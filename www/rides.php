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

   <p>My rides:</p>

   <table border="1">
    <tr>
    <th>Car</th>
    <th>From</th>
    <th>To</th> 
    <th>Day</th>
    <th>Hour</th>
    <th>Free places</th>
    <th colspan="10">Reserved by:</th>
    </tr> <tr>
    <?php 
    $query = $connection->query("SELECT r.id as ride_id, r.date as day, hour, start, destination, places, c.id as car_id, car, driver_id FROM Rides as r join Cars c ON r.car_id = c.id WHERE driver_id='$_SESSION[id]'");

  foreach($query as $row) { ?>
    <td> <?php echo $row['car'] ?> </td>
    <td> <?php echo $row['start'] ?> </td>
    <td> <?php echo $row['destination'] ?> </td>
    <td> <?php echo $row['day'] ?> </td>
    <td> <?php echo $row['hour'] ?> </td>
    <td> <?php echo $row['places'] ?> </td>
    <td>
    <form action="mod_ride.php" method="post">
          <input type='hidden' name="change" value=true></input>
          <input type='hidden' name="change_id" value=<?php echo $row['ride_id'] ?>></input>
           <button name="submit" type="submit">Modify</button></form>
        </td>
    <?php   $query2 = $connection->query("SELECT * FROM Reservations r join Users u ON u.id = user_id WHERE ride_id='$row[ride_id]'");
        foreach($query2 as $row2){ ?>
        <td><?php echo $row2['first_name'] . ' ' . $row2['last_name']?></td> <?php } ?>
        
        </tr>
    <?php } ?>
    </table>

    </br>


  <form action="account.php">
  <button name="submit" type="submit">Go back</button></form><br/>



</body>
</html>