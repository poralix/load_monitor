#!/bin/sh
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.3 $ Sun Jan 27 13:08:11 +07 2019             #
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
FILE_RAW=$(mktemp "${PLUGIN_DIR}/data/top.raw.XXXXXX");

top -n 1 -b > "${FILE_RAW}";
if [ -f "${FILE_RAW}" ]; then
    FILENAME_RAW=$(basename "${FILE_RAW}");
    /usr/local/bin/php -f "${PLUGIN_DIR}/exec/add.php" "${FILENAME_RAW}";
    rm "${FILE_RAW}";
    exit 0;
else
    echo "[ERROR][$(date)] Could no get stats from top output";
    exit 1;
fi;
