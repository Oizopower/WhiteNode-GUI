#!/bin/bash  
FILENAME="/var/www/public/whitenode.cmd"

chmod 755 $FILENAME

$FILENAME

rm -f $FILENAME
