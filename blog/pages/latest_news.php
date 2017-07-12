<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
     
      <title>Sajo's blog</title>

      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/a.css" rel="stylesheet">
  </head>
<body>
      <?php include_once "../header.php"; ?>
      <?php include_once "../nav.php"; ?>
      <?php include_once "../functions.php"; ?>
      <?php include_once "../database.php"; ?>
	  
<div class="container-fluid ">
	<div class="row">
		<div class="col-md-8 news-content">
			<?php 
				$blogovi=$db->query("
					SELECT * FROM blog 
				")->fetchAll(PDO::FETCH_ASSOC);
				//pagination
				$results_per_page=5;
				$number_results_db=count($blogovi);
				$number_pages=ceil($number_results_db/$results_per_page);
				if(!isset($_GET['page'])){
					$page=1;
				}else{
					$page=$_GET['page'];
				}
				$starting_limit_number=($page-1)*$results_per_page;
				$blogovi=$db->query("
					SELECT * FROM blog ORDER BY created DESC LIMIT " . $starting_limit_number ."," . $results_per_page . "
				")->fetchAll(PDO::FETCH_ASSOC);
				//end pagination
				foreach($blogovi as $blog){
					$blog_id=$blog['blog_id'];
					$blog_title = $blog['title'];
					$blog_text =trim(html_entity_decode($blog['text']));
					$text=current(explode('.', $blog_text));
					$blog_writer_id = $blog['blog_writer_id'];
					$blog_cat_id=$blog['cat_id'];
					$blog_image= $blog['blog_image'];
					$views = $blog['views'];
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
					echo"
					<div class='jumbotron jumbotron-fluid'>
						<img src='../admin/$blog_image'>
						<div class='container'>
							<h4 >$blog_title</h1>
							<p class='lead'>$text</p>
							<a href='single_blog.php?blog_id=$blog_id'>See More</a><br>
							<p class='list-blog-date'>Created by: $w_name $w_surname <br> On: $blog_date</p>
						</div>
					</div>
					";
				}?>
				<!--Page navigation-->
				<?php
				$previous_page=$page;
				if($previous_page>1){
					$back=$previous_page-1;
				}else{
					//disable button previous
					$back=1;
				}	
				$next_page=$page;
				if($next_page>=$number_pages){
					//disable button next
					$next=$page;
				}else{
					$next=$next_page+1;
				}
				?>
				<nav aria-label="Page navigation example" class="pagination-menu">
					<ul class="pagination">
						<li class="page-item" id="previous">
							<a class="page-link" href="latest_news.php?page=<?php echo $back; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
						</li>
					<?php
					for($page=1;$page<=$number_pages;$page++){
						echo '<li class="page-item"><a class="page-link" href="latest_news.php?page=' . $page . '">' . $page . '</a></li> ';
					}
					?>
						<li class="page-item">
							<a class="page-link" href="latest_news.php?page=<?php echo $next; ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
					</ul>
				</nav>
		</div>
	<!--pocetak sidebara -->
		<div class="col-md-3 sidebar">
			<center><h6>Most popular posts</h6></center>
			<hr>
		<?php 
		$blogovi=$db->query("
			SELECT * FROM blog ORDER BY views DESC LIMIT 5 
		")->fetchAll(PDO::FETCH_ASSOC);
		foreach($blogovi as $blog){
			$blog_id=$blog['blog_id'];
			$blog_title = $blog['title'];
			$blog_text =trim(html_entity_decode($blog['text']));
			$text=current(explode('.', $blog_text));
			$blog_writer_id = $blog['blog_writer_id'];
			$blog_cat_id=$blog['cat_id'];
			$blog_image= $blog['blog_image'];
			$views = $blog['views'];
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
		<a href='single_blog.php?blog_id=$blog_id'>
				<div class='card'>
					<img width='100%' height='100px' class='card-img-top' src='../admin/$blog_image' alt='No picture'>
					<div class='card-block'>
						<h4 class='card-title'>$blog_title</h4>
						<p class='card-text'>$text</p>
						<p id='creator'>Created by: $w_name $w_surname</p>
						<p id='views'>$views views</p>
					</div>
				</div>
		</a>
		";
		}
		
		?>
			
			
		</div>
	</div>
	<!--kraj sidebara-->
	</div>
</div>


<?php include_once '../footer.php'; ?>
  </body>
</html>