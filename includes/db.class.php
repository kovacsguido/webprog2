<?php
include_once('config.php');

/**
 * Class Database.
 */
class Database {
    private static $connection = null;

    /**
     * Database constructor.
     * A biztonság kedvéért készült private láthatósággal, hogy biztosan ne lehessen példányosítani az osztályt.
     */
    private function __construct() {}

    /**
     * Visszaadja az adatbázis kapcsolat egyetlen lehetséges példányát.
     *
     * @return PDO|null
     */
    public static function getConnection() {
        if (!self::$connection) {
            self::$connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            self::$connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        }
        return self::$connection;
    }
}
