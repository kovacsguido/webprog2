<?php

/**
 * Class Menu
 */
class Menu {
    /**
     * Menu constructor.
     * A biztonság kedvéért készült private láthatósággal, hogy biztosan ne lehessen példányosítani az osztályt.
     */
    private function __construct() {}

    /**
     * Visszaadja a megadott page id-jű oldalhoz tartozó tartalom elérési útját a szerveren.
     *
     * @param int $pid
     *
     * @return string A tartalom elérési útja
     */
    public static function getContentPath($pid)
    {
        $path = 'contents/404.php';

        $connection = Database::getConnection();
        $stmt = $connection->query("SELECT id, url FROM menu WHERE id=" . $pid);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result) && file_exists('contents/' . $result['url'] . '.php')) {
            $path = 'contents/' . $result['url'] . '.php';
        }

        return $path;
    }
}
