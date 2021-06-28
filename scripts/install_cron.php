<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.8 $ Thu Jul  9 01:01:56 +07 2020             #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

require_once dirname(dirname(__FILE__)) . '/exec/bootstrap.php';

$cronCurrent = trim(@file_get_contents($pathPlugin.'cron_current'));
$cronNew = array();

if(!empty($cronCurrent)) {
        $lines = explode("\n", $cronCurrent);
        foreach($lines as $line) {
                if(strpos($line, $pathPlugin) === false) {
                        $cronNew[] = $line;
                }
        }
}

$cronNew[] = '*/' . $config['intervalMinutes'] . ' * * * * cd '.$pathPlugin.'exec/; ./add.sh;';
file_put_contents($pathPlugin.'cron_new', implode("\n",$cronNew) . "\n");

echo 'crontab updated' . "\n";
