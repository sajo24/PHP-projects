<?php require VIEW_ROOT . '/templates/header.php'; ?>
Home
<br>
<?php


$pages=$db->query("
SELECT id,label,slug FROM pages
")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if(!empty($pages)): ?>
	<ul>
		<?php foreach ($pages as $page): ?>
			<li><a href="<?php echo BASE_URL; ?>/page.php?page=<?php echo $page['slug']; ?>"><?php echo $page['label']; ?></a></li></br>
		<?php endforeach; ?>
	</ul>
	<?php else: ?>
		<p>Sorry, no pages at the moment.</p>
	<?php endif;?>

			
			
			
			
<?php require VIEW_ROOT . '/templates/footer.php'; ?>
