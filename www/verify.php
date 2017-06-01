<?php

	$database   = "DB_0160748855";
	$user = "project";
	$password = "project";
	$host       = "mysql";
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);


	function encode($pass, $salt) {
    	return md5($salt . md5($pass . $salt));
 	}
	
	function salt($pass) {
    	return substr(md5(microtime() . substr($pass, 0, 3)), 0, 5);
  	}
  	
	function compare($passCompare, $pass, $salt) {
		return ($passCompare == encode($pass, $salt));
	}

	
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$stmt = $connection->prepare("SELECT * FROM Users WHERE username = ?");
		$stmt->bindParam(1, $_POST['username'], PDO::PARAM_STR, 20);
		$stmt->execute();
		$count = $stmt->rowCount();
		if ($count==1) {
	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['id'] = $result["id"];
			$_SESSION['username'] = $result["username"];
			$_SESSION['f_name'] = $result["first_name"];
			$_SESSION['l_name'] = $result["last_name"];
			$_SESSION['email'] = $result['email'];
			$_SESSION['address'] = $result['address'];
			$_SESSION['b_date'] = $result["birth_date"];
			$_SESSION['salt'] = $result["salt"];
			$enc_pass = $result["password"];

			if (compare($enc_pass, $_POST['password'], $result['salt']))
				header("Location: account.php");
			else {
				$_SESSION['message'] = "Incorrect login or password. Try again";
				header("Location: index.php");
			}

		}
	

	else if ($_POST['username']=='admin' and $_POST['password']=='admin') 
  		header("Location: admin.php");

	else {
		$_SESSION['message'] = "Incorrect login or password. Try again";
		header("Location: index.php");
	}
}
	

?>