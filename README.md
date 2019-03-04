# Name

Load Monitor

![Load Monitor Widget Preview in Evoution Skin](https://raw.githubusercontent.com/poralix/load_monitor/master/load_monitor_widget.png)

# Version

- Patched version: 0.2.6 (by Alex S Grebenschikov)
- Original version: 0.1 (written by Future Vision)

# Changes history:

- 0.2.6: Minor update is done to enable updates of the plugin via Directadmin interface
- 0.2.5: Minor changes: to use own php.ini. A fix for Debian 8 added.
- 0.2.4: An admin widget added for Evolution skin
- 0.2.3: Updated to work under Evolution skin

# Description

Load monitor plugin for Directadmin

# Author 

- Originally written by: Future Vision
- Patched by: Alex S Grebenschikov (www.poralix.com)


# Installation

```
cd /usr/local/directadmin/plugins/
git clone https://github.com/poralix/load_monitor.git
cd load_monitor/scripts/
./install.sh
```

Go to Directadmin panel as admin and click "Load Monitor"

Then go to the plugin settings and update:

- Maximum days to remember loads: default 91 (0 = all, more days = more space)
- Maximum task entries to save: default 91 (0 = all, more tasks = more space)
- Save interval in minutes: default 1

91 days of data with 1 minutes intervals might take up to 2Gb disk space and more.


# Warnings and requirements

Supported and tested OS:

- CentOS 6 and 7
- Debian 8

Potentially can work under  Debian versions (not tested though).

# Have ideas?

Please feel free to use it and let us know your thoughts and ideas for improvements.
