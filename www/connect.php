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
?>


<head>
	<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
</head>
	