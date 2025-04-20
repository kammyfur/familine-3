<?php

file_put_contents("/mnt/legacy/gl.json", json_encode($_POST));
exec("bash -c \"rm -Rfvd /mnt/github-data; mkdir /mnt/github-data; cd /mnt/github-data; git init; git pull https://minteck:xSf1M3AhmS2sTBsjGZpw@gitlab.minteck.org/minteck/unchained-text production; rm -Rfvd /mnt/blogchain/_posts/*; cp -r /mnt/github-data/* /mnt/blogchain/_posts; cp -r /mnt/github-data/.git /mnt/blogchain/_posts; cd /mnt/blogchain\" & > /tmp/github-reload.out");
