<?php
$options = [
    'uri'        => 'http://web2hf_web/soap/server.php',
    'location'   => 'http://web2hf_web/soap/server.php',
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