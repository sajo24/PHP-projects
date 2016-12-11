<?php require VIEW_ROOT . '/templates/header.php'; ?>

<?php if (!$page): ?>
	<p>No page found.</p>
<?php else: ?>

	<h2><?php echo escape($page['title']) ?></h2>
	
	<?php echo escape($page['body']); ?>
	
	<p class="faded">
		Created on <?php echo $page['created']->format('jS M Y'); ?>
		<?php if ($page['updated']): ?>
		Last update <?php echo $page['updated']->format('jS M Y'); ?>
		<?php endif; ?>
	</p>
<?php endif; ?>

<?php require VIEW_ROOT . '/templates/footer.php'; ?>