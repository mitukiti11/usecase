<?php

$pid = getmypid();
$root = realpath(__DIR__."/..");
$start = microtime(true);

require ("{$root}/vendor/autoload.php");

$s_in    = $_POST['in'];
$s_out   = $_POST['out'];
$s_cache = $_POST['cache'];

$addresses = array();
$a_cache2 = array();
$a_cache = explode('\t', $cache);
foreach ($a as $a_cache) {
	$a_cache2[] = trim($a);
}
$addresses[$a_cache2[0]] = [$a_cache2[1], $a_cache2[2]];
var_dump($addresses);

echo <<< "HTML"

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Title</title>
		
		<link rel="icon" href="/img/favicon.ico" type="image/vnd.microsoft.icon">
		<link rel="shortcut icon" href="/img/favicon.ico" type="image/vnd.microsoft.icon">
		<link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="192x192">
		
		<meta name="theme-color" content="#2196F3">
		
		<!-- assets -->
		<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
		<script src="/assets/vendor/popper.js/dist/umd/popper.js"></script>
		<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.js"></script>
		<link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" href="/assets/vendor/font-awesome/web-fonts-with-css/css/fontawesome-all.css"/>
		
	</head>
	<body>
		<form method="post">
			<textarea name="in" id="in"></textarea>
			<button>input</button>
			<textarea name="out" id="out"></textarea>
			<textarea name="cache" id="cache"></textarea>
			<button>cache</button>
		</form>
	</body>
</html>

HTML;
