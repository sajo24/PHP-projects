<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
     
      <title>Sajo's blog</title>

      <!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/a.css" rel="stylesheet">
  </head>
<body>

<?php
include_once("../database.php");
include_once("../functions.php");
?>
<div class="login" 	style="width: 300px;margin: 0 auto;">
<center><h2>Login</h2></center>
<form method="post" action="" name="login">
  <div class="form-group">
    <label>Enter Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username">
  </div>
  
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  
  <center><button type="submit" name="login" class="btn btn-primary">Login</button></center>
</form>
</div>


<?php 
if(isset($_POST['login'])){
	
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	$query="SELECT * FROM writers WHERE writer_username='$username' AND writer_password='$password'";

	$writer= $db->query($query)->fetchAll(PDO::FETCH_COLUMN);
	$writer_sum=count($writer);
	if($writer_sum == 1){
		setcookie("username", $username, time()+86400, "", "",false, true);
		setcookie("password", $password, time()+86400, "", "",false, true);
		header("Location: dashboard.php");
	}
	else{
		echo "Wrong password or username";
	}

	
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include_once 'footer.php'; ?>
  </body>
</html>