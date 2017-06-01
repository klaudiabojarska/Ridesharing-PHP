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
   <h2>All registred users:</h2>

   <table>

  <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Email address</th>
    <th>Home address</th>
    <th>Date of birth</th>
    <th>If valid</th>
  </tr>

	<?php 

	$stmt = $connection->query("SELECT * FROM Users");

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
		<td><?php if ($row['valid']) echo "yes"; else echo "no"?></td>
		<td>
		<form action="modify_admin.php" method="post">
		<input type="hidden" name="oo" value="true"> 
		<input type="hidden" name="ooo" value="<?php echo $row['id']?>">
		<button name="modify" type="submit">Modify</button></form></td>

		<td><form action="<?php echo $SCRIPT_NAME?>" method="post">
		<input type="hidden" name="del" value="true">
		<input type="hidden" name="del_id" value="<?php echo $row['id']?>">
		<button name="delete" type="submit">Delete</button> 
		</form></td><br/><?php
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST['del']){
			$stmt = $connection->query("DELETE FROM Users WHERE id = '$_POST[del_id]'");
			?> 
	        <meta http-equiv="refresh" content="0; <?php echo $SCRIPT_NAME ?>">
	        <?php
		}
	}
		?>
		</tr></table>
   		<br/>
	   <form action="admin.php">
	   <button name="submit" type="submit">Back</button></form><br/>
</body>
</html>