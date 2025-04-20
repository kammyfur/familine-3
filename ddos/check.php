<?php

$rid = rand(1111111111,9999999999);
$rays = explode(",", substr(substr(file_get_contents("/data/ddos/rays.json"), 1), 0, -1));
$rays[] = $rid;
$rays = file_put_contents("/data/ddos/rays.json", "[" . implode(",", $rays) . "]");

echo str_replace("%info%", base64_encode(file_get_contents("/data/ddos/info.html")), str_replace("%rayid%", $rid, file_get_contents("/data/ddos/check.html")));
