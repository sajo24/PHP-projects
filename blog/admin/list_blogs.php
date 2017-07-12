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
	  <link href="css/sidebar.css" rel="stylesheet">
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
<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 all-blogs">
				<div class="row">
			<?php
				if(isset($_GET['cat_id'])){
					
					$c_id=$_GET['cat_id'];
					$blogovi= $db->query ("
						SELECT *
						FROM blog 
						WHERE cat_id='$c_id'
						ORDER BY created DESC
						")->fetchAll(PDO::FETCH_ASSOC);
	
					foreach($blogovi as $blog){
						$blog_id=$blog['blog_id'];
						$blog_title = $blog['title'];
						$blog_text =html_entity_decode($blog['text']);
						$blog_writer_id = $blog['blog_writer_id'];
						$blog_cat_id=$blog['cat_id'];
						$blog_image= $blog['blog_image'];
		
						$blog_edit=$blog['edited'];
						if(!empty($blog_edit)){
							$edited = date_create($blog['edited']); 
							$date_edited=date_format($edited, 'd/m/Y H:i:s');
						}

						$date = date_create($blog['created']);
						$blog_date= date_format($date, 'd/m/Y H:i:s');
			
						echo "
							<div class='col-xs-4 col-sm-4 col-md-4'>
								<div class='thumbnail'>
									<img src='$blog_image' alt='Image is not available'>
							
								<div class='caption'>
									<h4>$blog_title</h3>
									<p>" . substr(trim($blog_text), 0, 250) ."...</p>
									<span>Created: $blog_date</span>
									<hr>
									<a href='edit.php?blog_id=$blog_id'><button class='btn btn-info'>Edit blog</button></a>
									<a style='float:right;'href='delete.php?blog_id=$blog_id'><button class='btn btn-info'>See more</button></a>
								</div>
								</div>
							</div>
						";
					}
				}
			?>
				</div>
			</div>
		</div>
	</div>
</div>
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