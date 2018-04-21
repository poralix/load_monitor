<?php

$pathPlugin = realpath(dirname(__FILE__) . '/../') . '/';

require_once $pathPlugin . 'scripts/functions.php';
require_once $pathPlugin . 'scripts/parseInputs.php';

$config = parse_ini_file($pathPlugin . 'scripts/config.ini');

$filename = dirname(__FILE__) . '/../data/load_monitor.sqlite';

if(file_exists($filename)) {
	$db = new PDO('sqlite:' . $filename);
}

$periods = array(
        1 => '00:00 - 03:59',
        2 => '04:00 - 07:59',
        3 => '08:00 - 11:59',
        4 => '12:00 - 15:59',
        5 => '16:00 - 19:59',
        6 => '20:00 - 23:59',
        7 => '00:00 - 23:59'
);
