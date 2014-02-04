#!/bin/bash

## invoke with chmod +x perm.sh && ./perm.sh
# changes all file permissions within the pollster app to function correctly!!
# @author Fritz DAvenport
# @param none
# @output none
##


echo `whoami`;
## code snippet changed from http://nixcraft.com/showthread.php/16287-Change-all-files-to-644-amp-drectories-to-755-FAST
find * -type f -print0 | xargs -I {} -0 chmod 0644 {}
find * -type d -print0 | xargs -I {} -0 chmod 0755 {}
## /code snippet
chmod 0777 pollster
chmod 0777 pollster/result
chmod 0767 pollster/admin/ax.csv
ls -lad pollster | xargs echo 
ls -la pollster/result | xargs echo 
ls -la pollster/admin/ax.csv | xargs echo 
