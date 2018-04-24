#!/bin/sh
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2 $ Wed Apr 25 00:34:10 +07 2018               #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

PLUGIN_DIR="/usr/local/directadmin/plugins/load_monitor";

top -n 1 -b > ${PLUGIN_DIR}/data/top.raw;
/usr/local/bin/php -f ${PLUGIN_DIR}/exec/add.php;
rm ${PLUGIN_DIR}/data/top.raw;
