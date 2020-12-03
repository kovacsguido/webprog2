<?php
include_once('../includes/config.php');

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
    'uri' => 'http://' . SITE_HOST . '/soap/server.php'
]);
$server->setClass('ServerSideService');
$server->handle();
