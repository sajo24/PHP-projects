<?php
include_once("database.php");

function getIp() 
{
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

//funkcija za ispis blogova(admin)
function getNbaBlogs(){
	global $db;
	$query="SELECT * FROM blog WHERE cat_id=1 ORDER BY created DESC
	";
	
	$blogovi=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($blogovi as $blog){
		$blog_id=$blog['blog_id'];
		$blog_title = $blog['title'];
		$blog_text =html_entity_decode ($blog['text']);
		
		$date = date_create($blog['created']);
		$blog_date= date_format($date, 'd/m/Y H:i:s');
		
		$blog_edit=$blog['edited'];
		
		if(!empty($blog_edit)){
		$edited = date_create($blog['edited']); 
		$date_edited=date_format($edited, 'd/m/Y H:i:s');
		}
		
		$blog_writer_id = $blog['blog_writer_id'];
		$blog_cat_id=$blog['cat_id'];
		$blog_image= $blog['blog_image'];
		
		
			
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
	
		

//funkcija za ispis euroligaskih blogova(admin)
function getEuroBlogs(){
	global $db;
	$query="SELECT * FROM blog WHERE cat_id=2 ORDER BY created DESC
	";
	$blogovi=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
	
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


//funkcija za ispis kategorija
function getCats(){
	global $db;
	$query="SELECT * FROM categories";
	$cats= $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
	
	
	foreach($cats as $cat){
		$kategorija=$cat['cat_name'];
		$kategorija_id=$cat['cat_id'];
		echo "<li><a href='#'>" . $kategorija . "</a></li>";
				
	}
}


//funkcija za prikazivanje najnovijih blogova
function getLatestBlogs(){
	global $db;
	$query1="
		SELECT * FROM blog
		LIMIT 6
	";
	$blogovi=$db->query($query1)->fetchAll(PDO::FETCH_ASSOC);

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
							<img src='../admin/$blog_image' alt='Image is not available'>
							
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


//funkcija za upload slika
function imageUpload($imageFile){
	
		$target_dir = "images/uploads/";
		$target_file = $target_dir . basename($imageFile["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

		$check = getimagesize($imageFile["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($imageFile["tmp_name"], $target_file)) {
				$image=$target_dir . basename($imageFile["name"]);
				return $image;
			}
			else {
				echo "<p>Sorry, there was an error uploading your file.</p>";
			}
		}
	
		
}



	
	
