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
		<!-- content -->
		<div id="content-wrapper">
			<div class="container-fluid">
				<div class='row'>
					<div class="col-lg-12 add-historic-game">
						<center><h2>Add New Historic Game</h2></center>
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="game_title" class="form-control" placeholder="Title">
							</div>
							
							<div class="form-group">
								<label>Enter content here</label>
								<textarea class="form-control" name="game_content"></textarea>
							</div>
							
							<div class="form-group">
								<label>Game video url</label>
								<input type="text" name="game_url" class="form-control" placeholder="URL">
							</div>
							<hr>
							<button type="submit" name="submit" class="btn btn-danger">Submit</button>
							<a href='javascript:history.go(-1)'><button type='button' class='btn btn-primary pull-right'>Go Back</button></a>
						</form>
					</div>
				 </div>
			</div>
		</div>
	<!--end of content -->
<?php


if(!empty($_COOKIE['username'] && $_COOKIE['password'])){
	if(isset($_POST['submit'])){
		$game_title=$_POST['game_title'];
		$text=htmlentities($_POST['game_content']);
		$game_content=nl2br($text);
		$url=$_POST['game_url'];
		$video_url = explode('v=', $url);
		$game_url = $video_url['1'];
		$writer_username=$_COOKIE['username'];
		$query="SELECT writer_id FROM writers WHERE writer_username='$writer_username'";
		$writer= $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
		foreach($writer as $w_id){
			$writer_id=$w_id['writer_id'];
		}
		
		$date=date("Y-m-d H:i:s");
		
		$insert_game=$db->prepare("
			INSERT INTO historic_games (game_url,game_title,game_text,game_writer_id,game_created)
			VALUES ('$game_url','$game_title','$game_content','$writer_id','$date')
		");
		$insert_game->execute([
			'game_url'=> $game_url,
			'game_title'=> $game_title,
			'game_text'=> $game_content,
			'game_writer_id'=> $writer_id,
			'game_created'=> $date
		]);
	}
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