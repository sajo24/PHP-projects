<?php
 include_once 'database.php'; 
 include_once 'header.php'; 
 ?>
  <div class="container-fluid">
 
      <ul class="nav nav-pills nav-fill">
	  
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">News</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="pages/latest_news.php">Latest news</a>
				<div class="dropdown-divider"></div>
				<?php
				$query="SELECT * FROM categories";
				$cats=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
				foreach($cats as $cat){
					$cat_id=$cat['cat_id'];
					$cat_name=$cat['cat_name'];
					echo "
						<a class='dropdown-item' href='pages/list_blogs.php?cat_id=$cat_id'>$cat_name</a>
					";
				}	
				?>
			</div>
		</li>
			
        <li class="nav-item">
			<a class="nav-link" href="#">Teams</a>
		</li>
		
        <li class="nav-item">
			<a class="nav-link" href="pages/historic_games.php">Historic games</a>
		</li>
		
        <li class="nav-item">
			<a class="nav-link" href="#">Legends</a>
		</li>
		
        <li class="nav-item">
			<a class="nav-link" href="#">Forum</a>
		</li>
		
		 <li class="nav-item">
			<a class="nav-link" href="#">About Us</a>
		</li>
    
      </ul>
	  
 
      
  </div><!-- /container-fluid -->
