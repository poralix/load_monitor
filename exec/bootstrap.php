<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.4 $ Sun Jan 27 17:26:09 +07 2019             #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

$pathPlugin = dirname(dirname(__FILE__)) . '/';

require_once $pathPlugin . 'exec/functions.php';
require_once $pathPlugin . 'exec/parseInputs.php';

if (isset($_SERVER["SKIN_NAME"]) && strtolower($_SERVER["SKIN_NAME"]) == "evolution") {
    define('EVOLUTION_SKIN', true);
} else {
    define('EVOLUTION_SKIN', false);
}

$config = parse_ini_file($pathPlugin . 'exec/config.ini');

$filename = $pathPlugin . 'data/load_monitor.sqlite';

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
