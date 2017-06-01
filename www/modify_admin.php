<?php
  session_start();
  include("connect.php");
?>

<html>
<head>
<title>Online car sharing</title>
</head>
   <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($_POST['oo']){
         $query = $connection->query("SELECT * FROM Users WHERE id='$_POST[ooo]'");
         $result = $query->fetch(PDO::FETCH_ASSOC);
         $_SESSION['id'] = $result['id'];
         $_SESSION['username'] = $result['username'];
         $_SESSION['f_name'] = $result["first_name"];
         $_SESSION['l_name'] = $result["last_name"];
         $_SESSION['email'] = $result['email'];
         $_SESSION['address'] = $result['address'];
         $_SESSION['b_date'] = $result["birth_date"];
      }

      if (isset($_SESSION) && $_POST['x']){
      $query = $connection->query("UPDATE Users SET username='$_POST[username]', first_name='$_POST[f_name]', last_name='$_POST[l_name]', email='$_POST[email]', address='$_POST[address]', birth_date='$_POST[b_date]' WHERE id='$_SESSION[id]'");
      if($_SERVER["REQUEST_METHOD"] == "POST") {
         $_SESSION['username'] = $_POST["username"];
         $_SESSION['f_name'] = $_POST['f_name'];
         $_SESSION['l_name'] = $_POST["l_name"];
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['address'] = $_POST['address'];
         $_SESSION['b_date'] = $_POST["b_date"];
      }}}
   ?>
<body>

   <h1>Online car sharing application</h1>
   <h2>Modify</h2>
   <form action="<?php echo $SCRIPT_NAME ?>" method="post">
   <table> <tr>
   <td>Firstname:</td>
   <td><input type="text" name="f_name" size="16" maxlength="20" value="<?php echo $_SESSION['f_name']?>"></td>
   </tr><tr>
   <td>Lastname:</td>
   <td><input type="text" name="l_name" size="16" maxlength="20" value="<?php echo $_SESSION['l_name']?>"></td>
   </tr><tr>
   <td>Username:</td>
   <td><input type="text" name="username" size="16" maxlength="20" value="<?php echo $_SESSION['username']?>"></td>
   </tr><tr>
   <td>Email address:</td>
   <td><input type="text" name="email" size="16" value=<?php echo $_SESSION['email']?>></td>
   </tr><tr>
   <td>Home address:</td>
   <td><input type="text" name="address" size="16" value=<?php echo $_SESSION['address']?>></td>
   </tr><tr>
   <td>Date of birth:</td>
   <td><input type="date" name="b_date" size="16" maxlength="20" value=<?php echo $_SESSION['b_date']?>></td>
   </tr></table>
   <br>
   <input type='hidden' name="x" value="true"></input>
   <button name="submit" type="submit">Submit</button></form> 


   <form action="showall.php">
   <button name="submit" type="submit">Go back</button></form>

   

</body>
</html>


