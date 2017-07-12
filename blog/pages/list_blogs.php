<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Sajo's blog</title>

      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/a.css" rel="stylesheet">
  </head>
<body>
      <?php include_once '../header.php'; ?>
      <?php include_once '../nav.php'; ?>
      <?php include_once '../functions.php'; ?>
      <?php include_once '../database.php'; ?>
	  
	  
<div class="container-fluid ">
	<div class="row blog-wrapper">
		
			<?php
			if(isset($_GET['cat_id'])){
				
				$c_id=$_GET['cat_id'];
				$blogovi= $db->query ("
						SELECT *
						FROM blog 
						WHERE cat_id='$c_id'
						")->fetchAll(PDO::FETCH_ASSOC);
	
					foreach($blogovi as $blog){
						$blog_id=$blog['blog_id'];
						$blog_title = $blog['title'];
						$blog_text =trim(html_entity_decode($blog['text']));
						$text=current(explode('.', $blog_text));
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
						
						$writers= $db->query ("
						SELECT *
						FROM writers 
						WHERE writer_id='$blog_writer_id'
						")->fetchAll(PDO::FETCH_ASSOC);
						
						foreach($writers as $writer){
							$w_name=ucwords($writer['writer_name']);
							$w_surname=ucwords($writer['writer_surname']);
						}
						echo "
							<div class='jumbotron jumbotron-fluid'>
								<img src='../admin/$blog_image'>
								<center><h2 class='display-5'>$blog_title</h2></center>
								<p class='lead'>
									$text...<br>
									<hr>
									<span class='list-blog-date'> Created: $blog_date</span>
									<span class='list-blog-writer'> Author: $w_name $w_surname</span>
								</p>
								<hr>
								<div class='list-buttons'>
									<a href='single_blog.php?blog_id=$blog_id'><button class='btn btn-danger list-blogs-buttons'>See More</button></a>
									<a style='float:right;'href='javascript:history.go(-1)'><button class='btn btn-danger list-blogs-buttons'>Go Back</button></a>
								</div>
							</div>
						";
					}
			}
			?>
				
	
	</div>
</div>

<?php include_once '../footer.php'; ?>
  </body>
</html>
