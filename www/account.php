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
   <p>Hello <?php echo $_SESSION['username']?></p>

	<?php 
	$stmt = $connection->query("SELECT valid FROM Users WHERE username = '$_SESSION[username]'");
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($result["valid"]) {
	?>

		<form action="modify.php">
		<input type="hidden" name="modify" value="<?php echo $row['id']?>">
		<button name="submit" type="submit">See/modify your account</button></form>

		<form action="add.php">
		<button name="submit" type="submit">Add your ride</button></form>

		<form action="search.php">
		<button name="submit" type="submit">Search for a ride</button></form>

		<form action="rides.php">
		<button name="submit" type="submit">See your rides</button></form>

	   <?php } else {  ?>

	   <p>Your account has not been activated yet by an administrator.</p>
	   <p>Please wait</p>
	   <?php } ?>
	   
	   <form action="logout.php">
	   <button name="submit" type="submit">Log out</button></form><br/>

	   
</body>
</html>