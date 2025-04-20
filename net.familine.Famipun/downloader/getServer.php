<?php

$json = json_decode(file_get_contents("../private/tunnels.json"));
header("Content-Type: text/plain");

echo(explode(":", explode("/", $json->tunnels[0]->public_url)[2])[0]);
