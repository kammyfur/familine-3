<?php

echo("-- START OF LOG FILE\n");

// Block if Ray ID is invalid

$config = json_decode(file_get_contents("/data/ddos/config.json"));

if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
else
  $ip   = $_SERVER['REMOTE_ADDR'];

$two_letter_country_code=iptocountry($ip);

function iptocountry($ip)
{
echo("IP address: " . $ip);
  $numbers = explode( ".", $ip);    

  include("ip_files/".$numbers[0].".php");
  $code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);    

  foreach($ranges as $key => $value)
  {
    if($key<=$code)
    {
      if($ranges[$key][0]>=$code)
      {
        $country=$ranges[$key][1];break;
      }
    }
  }

  if ($country=="")
  {
    $country="unknown";
  }

  return $country;
}
if (in_array($two_letter_country_code, $config->blocked))
  $blocked = true;
else
  $blocked = false;

if (!$blocked) {
    $mins = json_decode(file_get_contents("/data/ddos/requests/1min.json"));
    $secs = json_decode(file_get_contents("/data/ddos/requests/10secs.json"));
    
    if (isset($secs->$ip)) {
        if ($secs->$ip->count >= $config->max->per10) {
            $blocked = true;
        }
    }
    
    
    if (isset($mins->$ip)) {
        if ($mins->$ip->count >= $config->max->per60) {
            $blocked = true;
        }
    }
    
    if ($blocked) {
        unset($mins->$ip);
        unset($secs->$ip);
        file_put_contents("/data/ddos/blocks.txt", file_get_contents("/data/ddos/blocks.txt") . "\n" . $ip);
    }
}

// Add browser check

$ignoreCheck = true;
require_once $_SERVER['DOCUMENT_ROOT'] . "/ddos/session.php";

die("\n-- END OF LOG FILE");
