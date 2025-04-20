#!/bin/bash
echo "" > /data/ddos/blocks.txt
echo "{}" > /data/ddos/requests/1min.json
echo "{}" > /data/ddos/requests/10secs.json
echo "[]" > /data/ddos/rays.json
chmod -Rfv 777 /data/ddos
