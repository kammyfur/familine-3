<?php

echo("Familine Plus automatic renewal\n");
$_SERVER['DOCUMENT_ROOT'] = "/data";

$ousers = scandir($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles");
$users = [];
foreach ($ousers as $user) {
    if ($user != "." && $user != ".." && $user != "\$default.json" && $user != ".htaccess") {
        $users[] = substr($user, 0, (strlen($user) - 5));
    }
}

echo("Managing subscription for " . count($users) . " user(s)\n");

foreach ($users as $_USER) {
    echo("Treating profile of " . $_USER . "\n");

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json")) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/\$default.json"));
    }
    
    $_PROFILE = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json"));
    if (json_last_error() != JSON_ERROR_NONE) {
        echo("Corrupted Familine Plus: " . $_USER . "\n");
        return;
    }

    if ($_USER == "Administrateur" && isset($_GET['user'])) {
        $_USER = $_GET['user'];
    }
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json")) {
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
            <?php echo("Corrupted Faminey: " . $_USER . "\n"); ?>
        <?php return;endif;
    } else {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", str_replace("\$\$uid\$\$", rand(111111111111, 999999999999), file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json")));
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
            <?php echo("Corrupted Faminey: " . $_USER . "\n"); ?>
        <?php return;endif;
    }

    if ($_PROFILE->subscription == 0) {
        echo("User doesn't have active subscription");
    } else {
        echo("Calculating difference between latest renewal and now\n");
        $old = new DateTime($_PROFILE->last);
        $new = new DateTime("now");
        $diff = $old->diff($new);

        if ($diff->m >= 1) {
            echo("Renewal needed\n");
            $applicable = true;
            switch ($_PROFILE->subscription) {
                case 1:
                    echo("Renewing Plus Lite subscription\n");
                    $price = 0.25;
                    $name = "Lite";
                    break;

                case 2:
                    echo("Renewing Plus Pro subscription\n");
                    $price = 0.50;
                    $name = "Lite";
                    break;

                case 3:
                    echo("Renewing Plus Ultimate subscription\n");
                    $price = 0.75;
                    $name = "Lite";
                    break;

                case 4:
                    echo("Renewing Plus Dreams subscription\n");
                    $price = 1;
                    $name = "Lite";
                    break;
                
                default:
                    echo("Unrecognized subscription ID\n");
                    $applicable = false;
                    $price = -1;
                    $name = "Unknown";
                    break;
            }
            echo("Checking if user have enough money...\n");
            if (false) {
                echo("User do have enough money\n");
            } else {
                echo("User doesn't have enough money\n");
                $applicable = false;
            }
            if ($applicable) {
                echo("Will credit for renewal\n");
                $_PROFILE->last = date('Y') . "-" . date('m') . "-" . date('d');
                $profile->credit = $profile->credit - $price;
                array_unshift($profile->history, [
                    "name" => "Familine™ Plus " . $name,
                    "to" => "Familine™",
                    "cost" => ($price - ($price + $price)),
                    "date" => date('d') . "/" . date('m') . "/" . date('Y'),
                    "type" => "auto"
                ]);
                echo("Renewed, saving profile...\n");
                file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", json_encode($profile, JSON_PRETTY_PRINT));
                file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/plus/profiles/" . $_USER . ".json", json_encode($_PROFILE, JSON_PRETTY_PRINT));
                echo("Profile saved, next user\n");
            } else {
                echo("Not meeting requirement to renew, will disable subscription\n");
                $index = 0;
                foreach ($profile->subscriptions as $sub) {
                    if (substr($sub->name, 0, 16) == "Familine™ Plus" || substr($sub->name, 0, 30) == "Familine™ Famiwiki® Premium") {
                        unset($profile->subscriptions[$index]);
                    }

                    $index++;
                }
                $_PROFILE->subscription = 0;
                $_PROFILE->last = null;
                echo("Subscription disabled, saving profile...\n");
                file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", json_encode($profile, JSON_PRETTY_PRINT));
                file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/plus/profiles/" . $_USER . ".json", json_encode($_PROFILE, JSON_PRETTY_PRINT));
                echo("Profile saved, next user\n");
            }
        } else {
            echo("No renewal needed, last one was " . $diff->days . " day(s) ago\n");
        }
    }
}

echo("\n");
