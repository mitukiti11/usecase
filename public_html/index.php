<?php

$pid = getmypid();
$root = realpath(__DIR__."/..");
$start = microtime(true);

require ("{$root}/vendor/autoload.php");

$s_in    = $_POST['in'];
$s_out   = $_POST['out'];
$s_cache = $_POST['cache'];

// cache
$a_cache_addresses = array();
foreach (explode("\n", $s_cache) as $s_line) {
	if (trim($s_line) == "") continue;
	$d = explode("\t", $s_line);
	$a_cache_addresses[$d[0]] = [$d[1], $d[2]];
}

// input
$a_input_addresses = array();
foreach (explode("\n", $s_in) as $s_line) {
        if (trim($s_line) == "") continue;
        $a_input_addresses[] = trim($s_line);
}

// output
$a_outputs = array();
foreach ($a_input_addresses as $s_address) {
	$r = $a_cache_addresses[$s_address];
	$a_outputs[] = [$s_address, $r[0], $r[1]];
}


$outputs = array();
foreach ($a_outputs as $data) {
        $outputs[] = implode("\t", $data);
}
$s_output = implode("\n", $outputs);

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
			<textarea name="in" id="in">{$s_in}</textarea>
			<button>input</button>
			<textarea name="out" id="out">{$s_output}</textarea>
			<textarea name="cache" id="cache">{$s_cache}</textarea>
			<button>cache</button>
		</form>
	</body>
</html>

HTML;


