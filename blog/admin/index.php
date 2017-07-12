<?php 
session_start();
if (!empty($_COOKIE['username'] && $_COOKIE['password'])) {
	header("Location: dashboard.php");
	exit;
} else {
    header("Location: login.php");
}
?>