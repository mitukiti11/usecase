<?php

$pid = getmypid();
$root = realpath(__DIR__."/..");
$start = microtime(true);

require ("{$root}/vendor/autoload.php");




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
		<textarea id="in"></textarea><button>input</button>
		<textarea id="out"></textarea>
		<textarea id="cache"></textarea><button>cache</button>
		
	</body>
</html>

HTML;
