<?php

/**
 * Class Database.
 */
class Database {
    const HOST = 'web2hf_db';
    const DBNAME = 'web2hf';
    const USER = 'web2user';
    const PASSWORD = 'S3cr3tP4ssw0rd';

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
            self::$connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME, self::USER, self::PASSWORD,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            self::$connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        }
        return self::$connection;
    }
}
