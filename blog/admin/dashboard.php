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
				<hr>
				<li><a href="top10plays.php">Top 10 plays</a></li>
			</ul>
		</div>
		<!--end of sidebar menu-->
		<!-- content -->
		<div id="content-wrapper">
			<div class="container-fluid">
				<div class='row'>
					<div class="col-lg-12">
						<iframe src="http://www.youtube.com/embed/W7qWa52k-nE"
   width="560" height="315" frameborder="0" allowfullscreen></iframe>
					</div>
				 </div>
			</div>
		</div>
	
	<!--end of content -->
	

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$("#menu-toggle").click(function(e){
		e.preventDefault();
		$("#wrapper").toggleClass("menuDisplayed");
	});
</script>

<?php include_once 'footer.php'; ?>
  </body>
</html>