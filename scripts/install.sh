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
PHP_INI="${PLUGIN_DIR}/php.ini";

chown diradmin:diradmin ${PLUGIN_DIR}/*;
chown -R diradmin:diradmin "${PLUGIN_DIR}/admin/";
chown -R diradmin:diradmin "${PLUGIN_DIR}/data/";
chown -R diradmin:diradmin "${PLUGIN_DIR}/exec/";
chown -R diradmin:diradmin "${PLUGIN_DIR}/hooks/";
chown -R diradmin:diradmin "${PLUGIN_DIR}/scripts/";
chmod 755 ${PLUGIN_DIR}/admin/*.html;
chmod 755 ${PLUGIN_DIR}/exec/*.sh;

[ -f "${PLUGIN_DIR}/data/load_monitor.sqlite" ] || ${PLUGIN_DIR}/scripts/install_db.sh;
${PLUGIN_DIR}/scripts/install_cron.sh;

TZ=$(grep ^php_timezone= /usr/local/directadmin/custombuild/options.conf | cut -d= -f2);
perl -pi -e "s#^date.timezone = .*#date.timezone = ${TZ}#" ${PHP_INI};

GCC=gcc;
if [ -e /usr/bin/gcc ]; then
    GCC=/usr/bin/gcc;
elif [ -e /usr/local/bin/gcc ]; then
    GCC=/usr/local/bin/gcc;
elif [ -e /bin/gcc ]; then
    GCC=/bin/gcc;
fi;

WRAPPER="install-cron";
${GCC} -std=gnu99 -B/usr/bin -o ${PLUGIN_DIR}/exec/${WRAPPER} ${PLUGIN_DIR}/exec/${WRAPPER}.c >> /dev/null 2>&1;
chown root:diradmin ${PLUGIN_DIR}/exec/${WRAPPER};
chmod 4550 ${PLUGIN_DIR}/exec/${WRAPPER};

exit 0;
