#!/bin/sh
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

PLUGIN_DIR="/usr/local/directadmin/plugins/load_monitor";
PHP_INI="${PLUGIN_DIR}/php.ini";

# permissions
chown -R diradmin:diradmin "${PLUGIN_DIR}";
chmod 755 "${PLUGIN_DIR}";
chmod 755 ${PLUGIN_DIR}/admin/*.html;
chmod 755 ${PLUGIN_DIR}/exec/*.sh;

# config
CUSTOM_CONFIG="${PLUGIN_DIR}/exec/config.ini";
DEFAULT_CONFIG="${PLUGIN_DIR}/exec/config.ini.default";
[ -e "${CUSTOM_CONFIG}" ] || cp -p "${DEFAULT_CONFIG}" "${CUSTOM_CONFIG}";
chown diradmin:diradmin "${CUSTOM_CONFIG}";
chmod 644 "${CUSTOM_CONFIG}";

# php.ini
TZ=$(grep ^php_timezone= /usr/local/directadmin/custombuild/options.conf | cut -d= -f2);
perl -pi -e "s#^date.timezone = .*#date.timezone = ${TZ}#" ${PHP_INI};

# sqlite
[ -f "${PLUGIN_DIR}/data/load_monitor.sqlite" ] || ${PLUGIN_DIR}/scripts/install_db.sh;
${PLUGIN_DIR}/scripts/install_cron.sh;

# wrapper
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

# plugin's configs
cd "${PLUGIN_DIR}";
perl -pi -e "s/^installed=.*/installed=yes/" plugin.conf;
perl -pi -e "s/^active=.*/active=yes/" plugin.conf;

echo "Plugin installed...";

exit 0;
