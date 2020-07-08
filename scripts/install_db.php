<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.7 $ Thu Jul  9 01:01:56 +07 2020             #
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

echo 'creating database...' . "\n";

unset($db);
if (is_file($filename)) unlink($filename);

$db = new PDO('sqlite:' . $filename);
$db->exec("CREATE TABLE loads (
	created TEXT PRIMARY KEY,
	uptime TEXT,
	users INTEGER,
	one REAL,
	five REAL,
	fifteen REAL,
	task_total INTEGER,
	task_running INTEGER,
	task_sleeping INTEGER,
	task_stopped INTEGER,
	task_zombie INTEGER,
	cpu_us REAL,
	cpu_sy REAL,
	cpu_ni REAL,
	cpu_id REAL,
	cpu_wa REAL,
	cpu_hi REAL,
	cpu_si REAL,
	cpu_st REAL,
	mem_total INTEGER,
	mem_used INTEGER,
	mem_free INTEGER,
	mem_buffers INTEGER,
	swap_total INTEGER,
	swap_used INTEGER,
	swap_free INTEGER,
	swap_cached INTEGER,
	tasks BLOB
)");
