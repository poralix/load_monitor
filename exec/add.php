<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.9 $ Fri Aug  9 15:33:31 +07 2024             #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

require_once dirname(__FILE__) . '/bootstrap.php';

$save = array();
$file = (isset($argv[1]) && $argv[1]) ? $argv[1] : false;
$os_name = (isset($argv[2]) && $argv[2]) ? $argv[2] : false;
$os_version = (isset($argv[3]) && $argv[3]) ? intval($argv[3]) : false;

$data = file($pathPlugin.'data/'. basename($file));

$str = $data[0];
$up = 'up';
$str = trim(substr($str, (strpos($str, $up) + strlen($up))));

$loadAverage = 'load average:';
$loadPos = strpos($str, $loadAverage);
$uptimeUser = trim(trim(substr($str, 0, $loadPos)), ',');

$uptimeUser = explode(',', $uptimeUser);

$users = array_pop($uptimeUser);

$load = substr($str, $loadPos + strlen($loadAverage));
$loads = explode(',', $load);

$save = array();
$save['uptime'] = trim(implode(',', $uptimeUser));
$save['users'] = (int)$users;
$save['one'] = trim($loads[0]);
$save['five'] = trim($loads[1]);
$save['fifteen'] = trim($loads[2]);

$taskData = explode(',', $data[1]);
$save['task_total'] = trim(str_replace(array('Tasks:', 'total'), '', $taskData[0]));
$save['task_running'] = trim(str_replace('running', '', $taskData[1]));
$save['task_sleeping'] = trim(str_replace('sleeping', '', $taskData[2]));
$save['task_stopped'] = trim(str_replace('stopped', '', $taskData[3]));
$save['task_zombie'] = trim(str_replace('zombie', '', $taskData[4]));

$cpuData = explode(',', $data[2]);
$save['cpu_us'] = floatval(trim(str_replace(array('Cpu(s):', '%us', '%'), '', $cpuData[0])));
$save['cpu_sy'] = floatval(trim(str_replace('%sy', '', $cpuData[1])));
$save['cpu_ni'] = floatval(trim(str_replace('%ni', '', $cpuData[2])));
$save['cpu_id'] = floatval(trim(str_replace('%id', '', $cpuData[3])));
$save['cpu_wa'] = floatval(trim(str_replace('%wa', '', $cpuData[4])));
$save['cpu_hi'] = floatval(trim(str_replace('%hi', '', $cpuData[5])));
$save['cpu_si'] = floatval(trim(str_replace('%si', '', $cpuData[6])));
$save['cpu_st'] = floatval(trim(str_replace('%st', '', $cpuData[7])));

$memData = explode(',', $data[3]);
$save['mem_total'] = floatval(trim(str_replace(array('GiB Mem :', 'MiB Mem :', 'KiB Mem :', 'Mem:', 'k total'), '', $memData[0])));
$save['mem_used'] = floatval(trim(str_replace('k used', '', $memData[1])));
$save['mem_free'] = floatval(trim(str_replace('k free', '', $memData[2])));
$save['mem_buffers'] = floatval(trim(str_replace('k buffers', '', $memData[3])));

$swapData = explode(',', str_replace(array('used.', 'free.'), array('used,', 'free,'), $data[4]));
$save['swap_total'] = floatval(trim(str_replace(array('GiB Swap:', 'MiB Swap:', 'KiB Swap:', 'Swap:', 'k total'), '', $swapData[0])));
$save['swap_used'] = floatval(trim(str_replace('k used', '', $swapData[1])));
$save['swap_free'] = floatval(trim(str_replace('k free', '', $swapData[2])));
$save['swap_cached'] = floatval(trim(str_replace('k cached', '', $swapData[3])));

$taskData = array_slice($data, 7);
foreach($taskData as $taskRaw) {
        $taskRaw = trim($taskRaw);
        if(empty($taskRaw)) {
                continue;
        }

        if(isset($save['tasks']) && (count($save['tasks']) == $config['maxTasks'])) {
                continue;
        }

        $taskRaw = trim(preg_replace('/\s+/', ' ', $taskRaw));
        $task = explode(' ', $taskRaw);
        $save['tasks'][] = array(
                'pid' => $task[0],
                'user' => $task[1],
                'pr' => $task[2],
                'ni' => $task[3],
                'virt' => $task[4],
                'res' => $task[5],
                'shr' => $task[6],
                's' => $task[7],
                'cpu' => $task[8],
                'mem' => $task[9],
                'time' => $task[10],
                'cmd' => $task[11]
        );
}

$fields = array(
        'created',
        'uptime',
        'users',
        'one',
        'five',
        'fifteen',
        'task_total',
        'task_running',
        'task_sleeping',
        'task_stopped',
        'task_zombie',
        'cpu_us',
        'cpu_sy',
        'cpu_ni',
        'cpu_id',
        'cpu_wa',
        'cpu_hi',
        'cpu_si',
        'cpu_st',
        'mem_total',
        'mem_used',
        'mem_free',
        'mem_buffers',
        'swap_total',
        'swap_used',
        'swap_free',
        'swap_cached',
        'tasks'
);

$values = array(
        '"' . date('Y-m-d H:i:s') . '"',
        '"' . $save['uptime'] . '"',
        $save['users'],
        $save['one'],
        $save['five'],
        $save['fifteen'],
        $save['task_total'],
        $save['task_running'],
        $save['task_sleeping'],
        $save['task_stopped'],
        $save['task_zombie'],
        $save['cpu_us'],
        $save['cpu_sy'],
        $save['cpu_ni'],
        $save['cpu_id'],
        $save['cpu_wa'],
        $save['cpu_hi'],
        $save['cpu_si'],
        $save['cpu_st'],
        $save['mem_total'],
        $save['mem_used'],
        $save['mem_free'],
        $save['mem_buffers'],
        $save['swap_total'],
        $save['swap_used'],
        $save['swap_free'],
        $save['swap_cached'],
        '"' . base64_encode(json_encode($save['tasks'])) . '"'
);

$db->exec('INSERT INTO loads (`' . implode('`,`', $fields) . '`) VALUES(' . implode(',', $values) . ')');
// stop data loss if maxRemember set to 0 (never delete):
if ($config['maxRemember'] > 0) {
    $curr_hour = date("H");
    $curr_minute = date("i");
    $time_window = $config['intervalMinutes']*3;
    if (($curr_hour == 0) && ($curr_minute < $time_window)) {
        $db->exec('DELETE FROM loads WHERE DATE(created) < "' . date('Y-m-d', strtotime('-' . $config['maxRemember'] . ' days')) . ' "');
    }
    /*else {
        echo "Skipping a delete task, Hour=".$curr_hour.", Minute=".$curr_minute."\n";
    }*/
}
