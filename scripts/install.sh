#!/bin/sh

chown -R diradmin:diradmin /usr/local/directadmin/plugins/load_monitor/;
/usr/local/directadmin/plugins/load_monitor/scripts/install_db.sh;
echo 'Read the Help section inside the Load Monitor plugin for further instructions or nothing will happen :)';
exit 0;
