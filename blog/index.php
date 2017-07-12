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
      <?php include_once 'header.php'; ?>
      <?php include_once 'nav.php'; ?>
      <?php include_once 'functions.php'; ?>
      <?php include_once 'database.php'; ?>
	  
	  
<div class="container-fluid ">
	<div class="row">
		<!--pocetak main contenta-->
		<div class="col-md-9 slider">
			<?php 
					$query="SELECT * FROM blog ORDER BY created DESC LIMIT 5
					";
					$blogovi=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
					
					//prvi blog
					$blog1_img=$blogovi[0]['blog_image'];
					$blog1_title=$blogovi[0]['title'];
					$blog1_text=trim(html_entity_decode($blogovi[0]['text']));
					$text1=current(explode('.', $blog1_text));
					//drugi
					$blog2_img=$blogovi[1]['blog_image'];
					$blog2_title=$blogovi[1]['title'];
					$blog2_text=trim(html_entity_decode($blogovi[1]['text']));
					$text2=current(explode('.', $blog2_text));
					//treci
					$blog3_img=$blogovi[2]['blog_image'];
					$blog3_title=$blogovi[2]['title'];
					$blog3_text=trim(html_entity_decode($blogovi[2]['text']));
					$text3=current(explode('.', $blog3_text));
					//cetvrti
					$blog4_img=$blogovi[3]['blog_image'];
					$blog4_title=$blogovi[3]['title'];
					$blog4_text=trim(html_entity_decode($blogovi[3]['text']));
					$text4=current(explode('.', $blog4_text));
					//peti
					$blog5_img=$blogovi[4]['blog_image'];
					$blog5_title=$blogovi[4]['title'];
					$blog5_text=trim(html_entity_decode($blogovi[4]['text']));
					$text5=current(explode('.', $blog5_text));
?>
	<!--pocetak karusela-->
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
				</ol>
				
				<div class="carousel-inner" role="listbox">
				
				
					<div class="carousel-item active">
						<img class="d-block img-fluid" width="100%" height="200px" src= <?php echo "admin/" . $blog1_img; ?> alt="<?php echo $blog1_title;?>">
						<div class="carousel-caption d-none d-md-block carousel-caption-bg">
							<h3><?php echo $blog1_title;?></h3>
							<p><?php echo $text1;?></p>
						</div>
					</div>
					
					<div class="carousel-item ">
						<img class="d-block img-fluid" width="100%" height="200px" src=<?php echo "admin/" . $blog2_img; ?> alt=<?php echo $blog2_title;?>>
						<div class="carousel-caption d-none d-md-block carousel-caption-bg">
							<h3><?php echo $blog2_title;?></h3>
							<p><?php echo $text2;?></p>
						</div>
					</div>
					
					<div class="carousel-item ">
						<img class="d-block img-fluid" width="100%" height="200px" src=<?php echo "admin/" . $blog3_img; ?> alt=<?php echo $blog3_title;?>>
						<div class="carousel-caption d-none d-md-block carousel-caption-bg">
							<h3><?php echo $blog3_title;?></h3>
							<p><?php echo $text3;?></p>
						</div>
					</div>
					
					<div class="carousel-item ">
						<img class="d-block img-fluid" width="100%" height="200px" src=<?php echo "admin/" . $blog4_img; ?> alt=<?php echo $blog4_title;?>>
						<div class="carousel-caption d-none d-md-block carousel-caption-bg">
							<h3><?php echo $blog4_title;?></h3>
							<p><?php echo $text4;?></p>
						</div>
					</div>
					
					<div class="carousel-item ">
						<img class="d-block img-fluid" width="100%" height="200px" src=<?php echo "admin/" . $blog5_img; ?> alt=<?php echo $blog5_title;?>>
						<div class="carousel-caption d-none d-md-block carousel-caption-bg">
							<h3><?php echo $blog5_title;?></h3>
							<p><?php echo $text5;?></p>
						</div>
					</div>
				</div>
  
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
				
			</div>
			<!--kraj karusela-->
			<div class="about_us-container">
				<div class="about_us">
					<p id='a-title'>Welcome to the Sajo's NBA corner<p>
					<p id='a-text'>
						Be the first to get latest NBA news, scores and everything else you need to know about NBA.
						You missed some game last night? No problem. We have latest 9 min highlights in HD.
						For old school guys, there are historic games if you want to relive some of the most memorable games ever.
						Our writers are preparing some astonishing texts about basketball legends. Subscribe to make sure you don't miss a thing.</br>
						<br>
						<span id="ps"><b>Dejan Sarajlic, CEO of Sajo inc.</b></span>
					</p>

				</div>
				<img src="admin/images/curry.png">
			</div>
			
			<div class="top10 container-fluid">
				<div class="row">
				
					<div class="col-sm-4 col-md-4 col-lg-4 thumbnail">
						<div class='caption'>
							<b>Euroleague Latest Top 10 Plays</b>
						</div>
						<div class="top10video">
							<iframe src="http://www.youtube.com/embed/W7qWa52k-nE"
								width="100%" height="200px" frameborder="0" allowfullscreen>
							</iframe>
						</div>
					</div>
					
					<div class="col-sm-4 col-md-4 col-lg-4 thumbnail">
						<div class='caption'>
							<b>NBA Latest Top 10 Plays</b> 
						</div>
						<div class="top10video">
							<iframe src="http://www.youtube.com/embed/W7qWa52k-nE"
								width="100%" height="200px" frameborder="0" allowfullscreen>
							</iframe>
						</div>
					</div>
					
					<div class="col-sm-4 col-md-4 col-lg-4 thumbnail">
						<div class='caption'>
							<b>NCAA Latest Top 10 Plays</b>
						</div>
						<div class="top10video">
							<iframe src="http://www.youtube.com/embed/W7qWa52k-nE"
								width="100%" height="200px" frameborder="0" allowfullscreen>
							</iframe>
						</div>
					</div>
				</div>
			</div>				
		</div>
		<!-- kraj main contenta -->

		<!--pocetak sidebara -->
		<div class="col-md-2 sidebar">
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
		<a href='pages/single_blog.php?blog_id=$blog_id'>
				<div class='card'>
					<img width='100%' height='100px' class='card-img-top' src='admin/$blog_image' alt='No picture'>
					<div class='card-block'>
						<h4 class='card-title'>$blog_title</h4>
						<p class='card-text'>$text</p>
						<p id='creator'>Created by: $w_name $w_surname </p>
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

<?php include_once 'footer.php'; ?>
  </body>
</html>
