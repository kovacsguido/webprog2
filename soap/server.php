<?php

/**
 * Class ServerSideService.
 */
class ServerSideService
{
    /**
     * Visszaadja az aktuális dátumot.
     *
     * @return false|string
     */
    public function getDate()
    {
        return date("Y.m.d.");
    }

    /**
     * Visszaadja az aktuális időt.
     *
     * @return false|string
     */
    public function getTime()
    {
        return date("H:i:s");
    }
}

$server  = new SoapServer(null, [
    'uri' => 'http://web2hf_web/soap/server.php'
]);
$server->setClass('ServerSideService');
$server->handle();
