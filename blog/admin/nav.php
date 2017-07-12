
<?php include_once("../database.php"); ?>

<?php

if(!empty($_COOKIE['username'] && $_COOKIE['password'])){
	$writer_username=$_COOKIE['username'];
	$writer_pass=$_COOKIE['password'];
	
	$writers=$db->query("
		SELECT * FROM writers WHERE writer_username='$writer_username' AND writer_password='$writer_pass'
	")->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($writers as $writer){
		$name=ucwords($writer['writer_name']);
		$surname=ucwords($writer['writer_surname']);
	}

}
?>

<div class="navbar navbar-inverse navigation">
		<ul class="nav">
			<a href="#" id="menu-toggle"><img width="50px" height="50px" src="images/meni.png"></a>
			<span class="hello">Welcome back, <?php echo $name . $surname; ?></span> 
		</ul>
</div>


