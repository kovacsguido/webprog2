<?php

/**
 * Class Content
 */
class Content {
    /**
     * Content constructor.
     * A biztonság kedvéért készült private láthatósággal, hogy biztosan ne lehessen példányosítani az osztályt.
     */
    private function __construct() {}

    /**
     * Visszaadja a kért oldalhoz tartozó tartalmat.
     *
     * @param int $pid
     *
     * @return string A kért oldalhoz tartozó tartalom - vagy a 404-es oldalé, ha a kért oldal nem létezik
     */
    public static function getPageContent($pid)
    {
        ob_start();
        include Menu::getContentPath($pid);

        return ob_get_clean();
    }
}
