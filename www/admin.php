<?php
	session_start();
	include("connect1.php");

ob_start();

if(!isset($_COOKIE['valid']) ){
    setcookie('valid', 'manual');
    $_COOKIE['valid'] = 'manual';
}

if($_COOKIE['valid'] == "manual")
	$v = 0;

if($_COOKIE['valid'] == "auto")
	$v = 1;

if ($_GET['valid']=='manual') {
	$connection->query("ALTER TABLE Users MODIFY COLUMN valid BOOLEAN not null DEFAULT false");
	setcookie("valid","manual");
	ob_end_clean();
	$v = 0;
}
if ($_GET['valid']=='auto') {
	$connection->query("ALTER TABLE Users MODIFY COLUMN valid BOOLEAN not null DEFAULT true");
	setcookie("valid","auto");
	ob_end_clean();
	$v = 1;

}
	?>

<html>
<head>
<title>Online car sharing</title>
</head>

<body>
	<h1>Online car sharing application</h1>
	<p>Hello Admin</p>
	<form action="showall.php">
	<button name="submit" type="submit">Show me all users</button></form><br>
	<form action="regtover.php">
	<button name="submit" type="submit">Registrations to verify</button></form><br>
	<form action="chpass.php">
	<button name="submit" type="submit">Change my password</button></form><br>

			
<?php if (!$v) {?>
	<p>Manual mode. All new registrations are NOT automaticaly valid</p>
	<form action='admin.php?valid=auto'>
	<input type="hidden" name="valid" value="auto">
	<button name="submit" type="submit">Change mode to automatic</button>
	</form>
<?php } else { ?> 
	<p>Automatic mode. All new registrations are automaticaly valid</p>
	</form>
	<form action='admin.php?valid=manual'>
	<input type="hidden" name="valid" value="manual">
	<button name="submit" type="submit">Change mode to manual</button>
	</form>
<?php } ?>




	   <form action="logout.php">
	   <button name="submit" type="submit">Log out</button></form><br/>

	
</body>
</html>
<?php
    ob_end_flush();
?>