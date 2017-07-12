<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
     
      <title>Sajo's blog</title>

      <!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
	<link href="css/a.css" rel="stylesheet">
	
  </head>
<body>

<?php
include_once("header.php");
include_once("nav.php");
include_once("../database.php");
include_once("../functions.php");
?>

<div id="wrapper">
	
		<!--sidebar menu-->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li><a href="dashboard.php">Home</a></li>
				<hr>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Edit blogs <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php
							$query="SELECT * FROM categories";
							$cats=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
							foreach($cats as $cat){
								$cat_id=$cat['cat_id'];
								$cat_name=$cat['cat_name'];
							
								echo "
									<li><a href='list_blogs.php?cat_id=$cat_id'>$cat_name</a></li>
									";
							}
						?>
					</ul>
				</li>
				<li><a href="add_blog.php">Add blog</a></li>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Delete blogs <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php
							$query="SELECT * FROM categories";
							$cats=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
							foreach($cats as $cat){
								$cat_id=$cat['cat_id'];
								$cat_name=$cat['cat_name'];
							
								echo "
									<li><a href='delete_blogs.php?cat_id=$cat_id'>$cat_name</a></li>
									";
							}
						?>
					</ul>
				</li>
				<li><a href="add_cat.php">Add blog category</a></li>
				<li><a href="delete_cat.php">Delete blog category</a></li>
				<hr>
				<li><a href="list_games.php">Historic games</a></li>
				<li><a href="add_historic_game.php">Add historic game</a></li>
				<li><a href="delete_games.php">Delete historic game</a></li>
			</ul>
		</div>
		<!--end of sidebar menu-->
		<!--content-->
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 historic-game">
				<?php
				$g_id=$_GET['game_id'];
				
				$game=$db->query("
					SELECT * FROM historic_games WHERE game_id='$g_id'
				")->fetchAll(PDO::FETCH_ASSOC);
				foreach($game as $g){
					$game_id=$g['game_id'];
					$game_url=$g['game_url'];
					$game_title = $g['game_title'];
					$game_text =html_entity_decode($g['game_text']);
					$game_writer_id = $g['game_writer_id'];
					$date = date_create($g['game_created']);
					$game_date= date_format($date, 'd/m/Y H:i:s');
						
					$writers= $db->query ("
						SELECT * FROM writers WHERE writer_id='$game_writer_id'
					")->fetchAll(PDO::FETCH_ASSOC);
						
					foreach($writers as $writer){
						$w_name=ucwords($writer['writer_name']);
						$w_surname=ucwords($writer['writer_surname']);
					}
				}
				?>	
				<center><h1><?php echo $game_title; ?></h1></center>
				<div>
					<object width='100%' height='315' data='http://www.youtube.com/embed/<?php echo $game_url;?>'></object>
					<p><?php echo $game_text; ?></p>
				</div>
				<form method="post" action="">
					<hr>
					<button type="submit" name="delete" class="btn btn-danger">Delete blog</button>
					<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary pull-right">Go Back</button></a><br><br>
				</form>
			</div>
		</div>
	</div>
</div>
		
<?php
if(isset($_POST['delete'])){
	$sql = "DELETE FROM historic_games WHERE game_id='$game_id'";
	$db->exec($sql);		
	header("Location:list_games.php");	
}
?>
		
</div>		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$("#menu-toggle").click(function(e){
		e.preventDefault();
		$("#wrapper").toggleClass("menuDisplayed");
	});
</script>

<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php include_once 'footer.php'; ?>
  </body>
</html>