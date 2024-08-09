#!/bin/sh
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.9 $ Thu Jul  9 01:01:56 +07 2020             #
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

cd "${PLUGIN_DIR}";
perl -pi -e "s/^installed=yes/installed=no/" ./plugin.conf;
perl -pi -e "s/^active=yes/active=no/" ./plugin.conf;
echo "Plugin uninstalled...";

exit 0;
