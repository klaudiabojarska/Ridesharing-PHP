<?php
	session_start();
	include("connect.php");

?>

<html>
	<head>
		<title>Online car sharing</title>
	</head>
	<style>
	table, th, td {
	    border: 1px solid black;
	}
	th, td {
	    padding: 5px;
	}
	th, td {
	    text-align: center;
	}
</style>

<body>


   <h1>Online car sharing application</h1>
   <h2>Users without validation:</h2>

   <table>

  <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Email address</th>
    <th>Home address</th>
    <th>Date of birth</th>
  </tr>

	<?php 

	$stmt = $connection->query("SELECT * FROM Users WHERE valid = 'false'");

	foreach($stmt as $row) {
		?>
		<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['username']?></td>
		<td><?php echo $row['first_name']?></td>
		<td><?php echo $row['last_name']?></td>
		<td><?php echo $row['email']?></td>
		<td><?php echo $row['address']?></td>
		<td><?php echo $row['birth_date']?></td>
		<td>
		<form action="<?php echo $SCRIPT_NAME ?>" method="post">
		<input type="hidden" name="valid" value="<?php echo $row['id']?>">
		<button name="validd" type="submit">Validate</button></form></td><br/><?php
	}

        // $_POST['valid']=0;
     //header("Refresh:3");
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//if (isset($_POST['valid'])){
		echo $_POST['valid'];
		 $stmt2 = $connection->prepare("UPDATE Users SET valid = true WHERE id = ?");
         $stmt2->bindParam(1, $_POST['valid'], PDO::PARAM_INT);
         $stmt2->execute();
         $_POST['valid']=0;
         ?> 
         <meta http-equiv="refresh" content="0; <?php echo $SCRIPT_NAME ?>">
         <?php
		}
	//}
	
		?>
		</tr></table>
   		<br/>
	   <form action="admin.php">
	   <button name="submit" type="submit">Back</button></form><br/>
</body>
</html>