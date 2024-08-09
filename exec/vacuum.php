<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.9 $ Thu Jun 10 14:50:40 +07 2021             #
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

print "VACUUM started: ". date('r')."\n";
$db->exec('VACUUM;');
print "VACUUM finished: ". date('r')."\n";
