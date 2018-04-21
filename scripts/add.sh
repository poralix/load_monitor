#!/bin/sh
top -n 1 -b > top.raw
/usr/local/bin/php -f add.php
rm top.raw
