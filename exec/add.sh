#!/bin/sh
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.5 $ Fri Mar  1 12:20:55 +07 2019             #
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

da_os_major_version() {
    /usr/local/directadmin/directadmin o | grep 'Compiled on' | head -n1 | cut -d. -f1 | awk '{print $4}';
}

process_top_output() {
    top -n 1 -b > "${FILE_RAW}";
    if [ -f "${FILE_RAW}" ]; then
        FILENAME_RAW=$(basename "${FILE_RAW}");
        /usr/local/bin/php -nc/usr/local/directadmin/plugins/load_monitor/php.ini -f "${PLUGIN_DIR}/exec/add.php" "${FILENAME_RAW}" "${1}" "${2}";
        rm "${FILE_RAW}";
        exit 0;
    else
        echo "[ERROR][$(date)] Could not get stats from top output";
        exit 1;
    fi;
}

OS=$(uname);
OS_VERSION=$(da_os_major_version);
if [ "${OS}" == "FreeBSD" ]; then
    echo "[ERROR][$(date)] We don't support FreeBSD yet...";
    exit 1;
elif [ -e "/etc/debian_version" ]; then
    # Not tested enought on Debian yet, so it might fail....
    # Use it on your risk
    process_top_output "debian" "${OS_VERSION}";
else
    process_top_output "centos" "${OS_VERSION}";
fi;

exit 0;
