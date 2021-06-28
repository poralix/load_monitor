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

require_once 'config.php';

$db->exec('DELETE FROM loads');
