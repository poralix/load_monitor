#!/bin/sh
crontab -l > cron_current
/usr/local/bin/php -f install_cron.php
crontab cron_new
rm cron_current
rm cron_new
exit 0;

