<?php

function search() {
    global $vlan;
    global $best;
    global $last;

    $nodes = json_decode(file_get_contents("./private/computers.json"), true);
    $best = 1;
    $last = 0;
    foreach ($nodes as $node) {
        if ($node['vlan'] == $vlan) {
            if ($node['id'] > $last) {
                $last = $node['id'];
                $best = $last + 1;
            }
        }
    }
}

function check() {
    if ($best > 999) {
        $vlan++;
        search();
    }
}

header("Content-Type: text/plain");

if (isset($_GET['vlan'])) {
    $vlan = (int)$_GET['vlan'];
    if ($vlan < 1 || $vlan > 99) {
        $vlan = 10;
    }
} else {
    $vlan = 10;
}

if (isset($_GET['cat'])) {
    if (is_string($_GET['cat']) && strlen($_GET['cat']) == 1) {
        $cat = (string)$_GET['cat'];
    } else {
        $cat = "w";
    }
} else {
    $cat = "w";
}

search();
$name = "FLN" . sprintf("%02.0f", $vlan) . strtoupper($cat) . sprintf("%03.0f", $best);
die($name);