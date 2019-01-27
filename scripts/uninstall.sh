#!/bin/sh
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

PLUGIN_DIR="/usr/local/directadmin/plugins/load_monitor";

[ -f "${PLUGIN_DIR}/data/load_monitor.sqlite" ] && rm -f "${PLUGIN_DIR}/data/load_monitor.sqlite";

crontab -l | grep -v ${PLUGIN_DIR} > ${PLUGIN_DIR}/cron_new;
crontab ${PLUGIN_DIR}/cron_new;
rm -f ${PLUGIN_DIR}/cron_new;

exit 0;
