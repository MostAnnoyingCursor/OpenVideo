<?php
require("php/config.php");
$page = $_GET["page"];
$type = $_GET["type"];
if(empty($page) === true) { $page = "main"; }
if(empty($type) === true) { $type = "gui"; }
if($type === "gui") {
	?>
	<!DOCTYPE html>
	<html lang="ru">
	<head>
	<meta charset="utf-8">
	<title><? echo title($page) . " - " . site_name ?></title>
	<link rel="stylesheet" href="/font/font.css">
	<link rel="stylesheet" href="/files/style.css?">
	<script src="/files/jquery-1.9.1.js"></script>
	<script src="/files/script.js?"></script>
	<link rel="icon" href="/favicon.ico?" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico?" type="image/x-icon">
	</head>
	<body>
	<div class="container">
	<div class="header">
	<a href="/" class="logo"></a>
	<form method="GET" action="/" class="search">
	<input type="search" name="q" placeholder="Поиск видео...">
	<input type="submit" value="Поиск">
	</form>
	<a href="javascript:void(0)" class="account">
	<? 
	$sql = connect_to_mysql();
	if(check_session() === true) {
		$cookie = $_COOKIE["ov_cookie"];
		$query = $sql->query("SELECT username FROM users WHERE cookie='$cookie'");
		echo $query->fetch_row()[0];
	} else {
		echo "Аккаунт";
	}
	$sql->close;
	?>
	</a>
	</div>
	<div class="content">
	<? include("pages/$type/$page.php") ?>
	</div>
	<div class="footer">
	<p>(с) "Ты похож на кота", все права защищены.</p>
	</div>
	</div>
	<div class="menu" style="display:none">
	<? include("php/menu.php") ?>
	</div>
	</body>
	</html>
	<?
} elseif($type === "api") {
	include("pages/$type/$page.php");
} else {
	http_response_code(403);
}
?>