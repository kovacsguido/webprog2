<?php
include_once('../includes/config.php');

$options = [
    'uri'        => 'http://' . SITE_HOST . '/soap/server.php',
    'location'   => 'http://' . SITE_HOST . '/soap/server.php',
    'keep_alive' => false,
];
try {
    $soapClient = new SoapClient(null, $options);
    $currentDate = $soapClient->getDate();
    $currentTime = $soapClient->getTime();

    if (!empty($currentDate) && !empty($currentTime)) {
        $response = 'A mai dátum ' . $currentDate . ', a pontos idő pedig ' . $currentTime;
    }
    else {
        $response = 'Sajnos nem tudom, hogy mennyi idő van :-(';
    }
}
catch (SoapFault $e) {
    $response = $e->getMessage();
}

echo $response;