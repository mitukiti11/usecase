<?php

use josegonzalez\Dotenv\Loader as DotEnvLoader;

$pid = getmypid();
$root = realpath(__DIR__."/..");
$start = microtime(true);

require ("{$root}/vendor/autoload.php");



// mysqli
if (file_exists("{$root}/.env")) {
        $loader = (new DotEnvLoader("{$root}/.env"))->parse()->toEnv();
}
$mysqli = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
if ($mysqli->connect_error) {
	echo $mysqli->connect_error;
 	exit();
}
$mysqli->set_charset("utf8");






$data_cache = array();
$sql = "SELECT address, lat, lng FROM cache";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $data_cache[$row['address']] = [$row['lat'], $row['lng']];
    }
    $result->close();
}


$s_in    = $_POST['in'];
$s_out   = $_POST['out'];
$s_cache = $_POST['cache'];

// cache
$a_cache_addresses = array();
foreach (explode("\n", $s_cache) as $s_line) {
	if (trim($s_line) == "") continue;

        $d = explode("\t", $s_line);
	if (array_key_exists($d[0], $data_cache)) continue;

	$data_cache[$d[0]] = [$d[1], $d[2]];
	
	$sql = "INSERT INTO cache ( address, lat, lng) VALUES (\"{$d[0]}\", \"{$d[1]}\", \"{$d[2]}\");";
	$res = $mysqli->query($sql);
}
$a_cache_addresses = $data_cache;

// input
$a_input_addresses = array();
foreach (explode("\n", $s_in) as $s_line) {
        if (trim($s_line) == "") continue;
        $a_input_addresses[] = trim($s_line);
}

// output
$a_outputs = array();
foreach ($a_input_addresses as $s_address) {
	if (! array_key_exists($s_address, $data_cache)) {
		$sql = "INSERT INTO address (address) VALUES (\"{$s_address}\");";
        	$res = $mysqli->query($sql);
	}
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


