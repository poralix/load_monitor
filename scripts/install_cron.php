<?php

require_once dirname(__FILE__) . '/bootstrap.php';

$cronCurrent = trim(@file_get_contents('cron_current'));

$cronNew = array();
if(!empty($cronCurrent)) {
        $lines = explode("\n", $cronCurrent);
        foreach($lines as $line) {
                if(strpos($line, '/usr/local/directadmin/plugins/load_monitor/scripts/') === false) {
                        $cronNew[] = $line;
                }
        }
}

$cronNew[] = '*/' . $config['intervalMinutes'] . ' * * * * cd /usr/local/directadmin/plugins/load_monitor/scripts/; ./add.sh;';

file_put_contents('cron_new', implode("\n",$cronNew) . "\n");

echo 'crontab updated' . "\n";
