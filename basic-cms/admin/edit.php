<?php

require '../app/start.php';

if (!empty($_POST)) 
{
		$id = $_POST['id'];
		$title = $_POST['title'];
		$slug = $_POST['slug'];
		$body = $_POST['body'];
		$label = $_POST['label'];
	
	$update=("
	UPDATE pages
	SET label = :label,
		title = :title,
		slug = :slug,
		body = :body,
		updated = NOW()
	WHERE id = :id
	");
	$updatePage = $db->prepare($update);
	$updatePage->execute([
		'id' 	=> $id,
		'label' => $label,
		'title' => $title,
		'body'  => $body,
		'slug'  => $slug,
	]);
	
	header('Location:' . BASE_URL . '/admin/list.php');
}

if (!isset($_GET['id']))
	{
	header('Location: ' . BASE_URL . '/admin/list.php');
	die();
	}
$page = $db->prepare ("
	SELECT id,title,label,body, slug
	FROM pages
	WHERE id= :id
");
	
$page->execute(['id' => $_GET['id']]);

$page = $page->fetch(PDO::FETCH_ASSOC);


require VIEW_ROOT . '/admin/edit.php';



?>

