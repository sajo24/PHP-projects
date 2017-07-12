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
	   
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
  </head>
<body>

<?php
include_once("header.php");
include_once("nav.php");
include_once("../database.php");
include_once("../functions.php");
?>

<?php
if(!empty($_COOKIE['username'] && $_COOKIE['password'])){	
		if(isset($_GET['blog_id'])){
					
					$b_id=$_GET['blog_id'];
		
					$blogs = $db->query ("
						SELECT *
						FROM blog
						WHERE blog_id='$b_id'
						")->fetchAll(PDO::FETCH_ASSOC);
	
					foreach($blogs as $b)
					{
						$blog_title = $b['title'];
						$blog_text =html_entity_decode($b['text']);
						$blog_cat = $b['cat_id'];
						$blog_image = $b['blog_image'];
					}			
		}
}

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
		<center><h2>Edit Blog</h2></center>
			<div class="col-md-10 col-md-offset-1 edit-content">
				<form method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="blog_title" class="form-control" placeholder="Title" value="<?php echo $blog_title; ?>">
					</div>
				
					<div class="form-group">
						<label>Choose category</label>
						<select class="form-control" name="blog_cat">
						<option disabled><b>Select a category</b></option>
						<?php
							$cats = $db->query ("
								SELECT *
								FROM categories
								")->fetchAll(PDO::FETCH_ASSOC);

							foreach ($cats as $cat)
							{
								$s_catid=$cat['cat_id'];
								$s_cat=$cat['cat_name'];
								echo "<option value='$s_catid'>$s_cat</option>";
							}
						?>
						</select>
					</div>
				
					<div class="form-group">
						<label>Enter content here</label>
						<textarea name="blog_content" ><?php echo $blog_text; ?></textarea>
					</div>
				
					<label for="exampleInputFile">Image input</label>
				
					<div class="form-group">
						<img width='300' height='300' src='<?php echo $blog_image; ?>'>
						<input type="file" name="blog_image" id="exampleInputFile">
					</div>
					<hr>
					<button type="submit" name="submit" class="btn btn-success">Edit</button>
					<a href="javascript:history.go(-1)"><button type="button" class="btn btn-danger pull-right">Go Back</button></a>
				</form>
			</div>
		</div>
	</div>
</div>
</div>


<?php
if(isset($_POST['submit'])){
	if(isset($_GET['blog_id'])){
					
					$b_id=$_GET['blog_id'];
		
					$blogs = $db->query ("
						SELECT *
						FROM blog
						WHERE blog_id='$b_id'
						")->fetchAll(PDO::FETCH_ASSOC);
	
					foreach($blogs as $b)
					{
						$blog_title = $b['title'];
						$blog_text = $b['text'];
						$blog_cat = $b['cat_id'];
						$blog_image = $b['blog_image'];
					}			
		}
	
	$blog_title=$_POST['blog_title'];
	$blog_cat=$_POST['blog_cat'];
	$blog_content=htmlentities($_POST['blog_content']);
	//unosenje slike
	if(empty($_FILES['blog_image']['name'])){
		$image=$blog_image;
	}
	else{
		$image=imageUpload($_FILES['blog_image']);
	}
	
	
	$date=date("Y-m-d H:i:s");
	
	$edit_blog= $db->prepare ("
	UPDATE blog SET title = '$blog_title' , text= '$blog_content', edited='$date', cat_id='$blog_cat', blog_image='$image'
	WHERE blog_id='$b_id'
	");
	
	$edit_blog->execute();
?>
<script>
window.onload = function() {
    if (!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>
<?php
}
?>

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